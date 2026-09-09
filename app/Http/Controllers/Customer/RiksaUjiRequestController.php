<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\AdminNewRequestNotification;
use App\Mail\CustomerRequestConfirmation;
use App\Models\Company;
use App\Models\InspectionRequest;
use App\Models\InspectionRequestObject;
use App\Models\RiksaUjiCategory;
use App\Models\RiksaUjiType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RiksaUjiRequestController extends Controller
{
    private const SESSION_KEY = 'riksa_uji_draft';

    private const TOTAL_STEPS = 8;

    private array $stepTitles = [
        1 => 'Data Pemohon',
        2 => 'Data Perusahaan',
        3 => 'Data Objek K3',
        4 => 'Riksa Uji Sebelumnya',
        5 => 'Lokasi Pemeriksaan',
        6 => 'Dokumen Pendukung',
        7 => 'Review',
        8 => 'Selesai',
    ];

    public function create(): View
    {
        $user = Auth::user();
        $user->load('customerProfile.company');

        $draft = Session::get(self::SESSION_KEY, []);

        // Pre-fill draft from profile on first visit
        if (empty($draft['current_step'])) {
            $profile = $user->customerProfile;
            $company = $profile?->company;

            $draft = array_merge($draft, [
                'current_step' => 1,
                'applicant_name' => $profile?->full_name ?? $user->name,
                'applicant_position' => $profile?->job_title ?? '',
                'applicant_phone' => $profile?->phone ?? '',
                'applicant_email' => $user->email,
                'company_name' => $company?->name ?? '',
                'company_address' => $company?->address ?? '',
                'company_province' => $company?->province ?? '',
                'company_city' => $company?->city ?? '',
                'company_district' => $company?->district ?? '',
                'company_postal_code' => $company?->postal_code ?? '',
                'company_phone' => $company?->phone ?? '',
                'company_email' => $company?->email ?? '',
                'company_nib' => $company?->nib ?? '',
                'company_npwp' => $company?->npwp ?? '',
            ]);

            Session::put(self::SESSION_KEY, $draft);
        }

        $step = $draft['current_step'] ?? 1;

        return view('customer.riksa-uji.form', [
            'user' => $user,
            'draft' => $draft,
            'step' => $step,
            'totalSteps' => self::TOTAL_STEPS,
            'stepTitles' => $this->stepTitles,
            'categories' => RiksaUjiCategory::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function storeStep(Request $request, int $step): RedirectResponse
    {
        $validated = $this->validateStep($request, $step);

        $draft = Session::get(self::SESSION_KEY, []);
        $draft = array_merge($draft, $validated);
        $draft['current_step'] = $step + 1;

        if ($step === 6) {
            $draft = $this->storeStep6Files($request, $draft);
        }

        Session::put(self::SESSION_KEY, $draft);

        if ($step === 7) {
            return $this->submitRequest($draft);
        }

        return redirect()->route('customer.requests.create');
    }

    public function previousStep(int $step): RedirectResponse
    {
        $draft = Session::get(self::SESSION_KEY, []);
        $draft['current_step'] = max(1, $step - 1);
        Session::put(self::SESSION_KEY, $draft);

        return redirect()->route('customer.requests.create');
    }

    public function goToStep(int $step): RedirectResponse
    {
        $draft = Session::get(self::SESSION_KEY, []);
        $currentStep = $draft['current_step'] ?? 1;

        if ($step >= 1 && $step <= $currentStep) {
            $draft['current_step'] = $step;
            Session::put(self::SESSION_KEY, $draft);
        }

        return redirect()->route('customer.requests.create');
    }

    public function getTypes(Request $request): JsonResponse
    {
        $categoryId = $request->input('category_id');

        $types = RiksaUjiType::where('category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name']);

        return response()->json($types);
    }

    public function getCustomerCompanies(): JsonResponse
    {
        $user = Auth::user();
        $companies = Company::whereHas('inspectionRequests', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->orWhere('id', $user->customerProfile?->company_id)
            ->distinct()
            ->get(['id', 'name', 'address', 'province', 'city', 'district', 'postal_code', 'phone', 'email', 'nib', 'npwp']);

        return response()->json($companies);
    }

    public function addObject(): JsonResponse|RedirectResponse
    {
        $draft = Session::get(self::SESSION_KEY, []);
        $objects = $draft['objects'] ?? [];
        $objects[] = [];
        $draft['objects'] = $objects;
        Session::put(self::SESSION_KEY, $draft);

        if (request()->ajax()) {
            return response()->json([
                'object' => [
                    'category_id' => '', 'type_id' => '', 'object_name' => '', 'brand' => '', 'model' => '',
                    'serial_number' => '', 'factory_number' => '', 'manufacture_year' => '', 'capacity' => '',
                    'capacity_unit' => '', 'types' => [],
                ],
            ]);
        }

        return redirect()->route('customer.requests.create');
    }

    public function removeObject(int $index): JsonResponse|RedirectResponse
    {
        $draft = Session::get(self::SESSION_KEY, []);
        $objects = $draft['objects'] ?? [];
        if (isset($objects[$index])) {
            array_splice($objects, $index, 1);
        }
        $draft['objects'] = $objects;
        Session::put(self::SESSION_KEY, $draft);

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('customer.requests.create');
    }

    public function index(): View
    {
        $user = Auth::user();
        $requests = InspectionRequest::forUser($user->id)
            ->with('objects')
            ->orderByDesc('submitted_at')
            ->paginate(10);

        return view('customer.permohonan.index', [
            'requests' => $requests,
        ]);
    }

    public function show(InspectionRequest $request): View
    {
        abort_unless($request->user_id === Auth::id(), 403);

        $request->load(['objects.category', 'objects.type', 'company', 'notes', 'documents']);

        return view('customer.permohonan.show', [
            'request' => $request,
        ]);
    }

    private function storeStep6Files(Request $request, array $draft): array
    {
        $files = [];

        $photoObject = $request->file('photo_object');
        if ($photoObject) {
            $path = $photoObject->store('requests/documents', 'public');
            $files[] = [
                'name' => 'Foto Objek',
                'type' => 'request',
                'file_path' => $path,
                'file_name' => $photoObject->getClientOriginalName(),
                'mime_type' => $photoObject->getMimeType(),
                'file_size' => $photoObject->getSize(),
            ];
        }

        $photoNameplate = $request->file('photo_nameplate');
        if ($photoNameplate) {
            $path = $photoNameplate->store('requests/documents', 'public');
            $files[] = [
                'name' => 'Foto Nameplate',
                'type' => 'request',
                'file_path' => $path,
                'file_name' => $photoNameplate->getClientOriginalName(),
                'mime_type' => $photoNameplate->getMimeType(),
                'file_size' => $photoNameplate->getSize(),
            ];
        }

        $supportingDocs = $request->file('supporting_documents');
        if (is_array($supportingDocs)) {
            foreach ($supportingDocs as $index => $doc) {
                $path = $doc->store('requests/documents', 'public');
                $files[] = [
                    'name' => 'Dokumen Pendukung #'.($index + 1),
                    'type' => 'request',
                    'file_path' => $path,
                    'file_name' => $doc->getClientOriginalName(),
                    'mime_type' => $doc->getMimeType(),
                    'file_size' => $doc->getSize(),
                ];
            }
        }

        $draft['step6_files'] = $files;

        return $draft;
    }

    private function validateStep(Request $request, int $step): array
    {
        return match ($step) {
            1 => $request->validate([
                'applicant_name' => ['required', 'string', 'max:255'],
                'applicant_position' => ['nullable', 'string', 'max:255'],
                'applicant_phone' => ['required', 'string', 'max:20'],
                'applicant_email' => ['required', 'email', 'max:255'],
            ]),
            2 => $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'company_address' => ['nullable', 'string'],
                'company_province' => ['nullable', 'string', 'max:255'],
                'company_city' => ['nullable', 'string', 'max:255'],
                'company_district' => ['nullable', 'string', 'max:255'],
                'company_postal_code' => ['nullable', 'string', 'max:10'],
                'company_phone' => ['nullable', 'string', 'max:20'],
                'company_email' => ['nullable', 'email', 'max:255'],
                'company_nib' => ['nullable', 'string', 'max:255'],
                'company_npwp' => ['nullable', 'string', 'max:255'],
            ]),
            3 => $request->validate([
                'objects' => ['required', 'array', 'min:1'],
                'objects.*.category_id' => ['required', 'exists:riksa_uji_categories,id'],
                'objects.*.type_id' => ['nullable', 'exists:riksa_uji_types,id'],
                'objects.*.object_name' => ['required', 'string', 'max:255'],
                'objects.*.brand' => ['nullable', 'string', 'max:255'],
                'objects.*.model' => ['nullable', 'string', 'max:255'],
                'objects.*.serial_number' => ['nullable', 'string', 'max:255'],
                'objects.*.factory_number' => ['nullable', 'string', 'max:255'],
                'objects.*.manufacture_year' => ['nullable', 'string', 'max:4'],
                'objects.*.capacity' => ['nullable', 'string', 'max:50'],
                'objects.*.capacity_unit' => ['nullable', 'string', 'max:50'],
            ]),
            4 => $request->validate([
                'has_previous_inspection' => ['nullable', 'string'],
                'previous_certificate_number' => ['nullable', 'string', 'max:255'],
                'previous_inspection_date' => ['nullable', 'date'],
                'certificate_expiry_date' => ['nullable', 'date'],
                'previous_pjk3' => ['nullable', 'string', 'max:255'],
                'previous_certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            ]),
            5 => $request->validate([
                'inspection_address' => ['nullable', 'string'],
                'inspection_province' => ['nullable', 'string', 'max:255'],
                'inspection_city' => ['nullable', 'string', 'max:255'],
                'inspection_district' => ['nullable', 'string', 'max:255'],
                'inspection_postal_code' => ['nullable', 'string', 'max:10'],
                'location_notes' => ['nullable', 'string'],
                'same_as_company' => ['nullable', 'boolean'],
            ]),
            6 => [
                'photo_object' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
                'photo_nameplate' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
                'supporting_documents' => ['nullable', 'array'],
                'supporting_documents.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            ],
            7 => $request->validate([
                'consent' => ['required', 'accepted'],
            ]),
            default => [],
        };
    }

    private function submitRequest(array $draft): RedirectResponse
    {
        $user = Auth::user();

        $request = DB::transaction(function () use ($user, $draft) {
            // Create or find company
            $companyId = null;
            if (! empty($draft['company_name'])) {
                $companyData = [
                    'address' => $draft['company_address'] ?? null,
                    'province' => $draft['company_province'] ?? null,
                    'city' => $draft['company_city'] ?? null,
                    'district' => $draft['company_district'] ?? null,
                    'postal_code' => $draft['company_postal_code'] ?? null,
                    'phone' => $draft['company_phone'] ?? null,
                    'email' => $draft['company_email'] ?? null,
                    'nib' => $draft['company_nib'] ?? null,
                    'npwp' => $draft['company_npwp'] ?? null,
                ];

                $company = Company::firstOrCreate(
                    ['name' => $draft['company_name']],
                    $companyData
                );
                $companyId = $company->id;

                // Link to customer profile
                $profile = $user->customerProfile;
                if ($profile && ! $profile->company_id) {
                    $profile->update(['company_id' => $companyId]);
                }
            }

            $inspectionRequest = InspectionRequest::create([
                'request_number' => InspectionRequest::generateRequestNumber(),
                'user_id' => $user->id,
                'company_id' => $companyId,
                'status' => 'new',
                'applicant_name' => $draft['applicant_name'],
                'applicant_position' => $draft['applicant_position'] ?? null,
                'applicant_phone' => $draft['applicant_phone'],
                'applicant_email' => $draft['applicant_email'],
                'inspection_address' => $draft['inspection_address'] ?? null,
                'inspection_province' => $draft['inspection_province'] ?? null,
                'inspection_city' => $draft['inspection_city'] ?? null,
                'inspection_district' => $draft['inspection_district'] ?? null,
                'inspection_postal_code' => $draft['inspection_postal_code'] ?? null,
                'location_notes' => $draft['location_notes'] ?? null,
                'has_previous_inspection' => ($draft['has_previous_inspection'] ?? '0') === '1',
                'previous_certificate_number' => $draft['previous_certificate_number'] ?? null,
                'previous_inspection_date' => $draft['previous_inspection_date'] ?? null,
                'certificate_expiry_date' => $draft['certificate_expiry_date'] ?? null,
                'previous_pjk3' => $draft['previous_pjk3'] ?? null,
                'submitted_at' => now(),
            ]);

            // Create request objects
            foreach ($draft['objects'] as $objectData) {
                InspectionRequestObject::create([
                    'inspection_request_id' => $inspectionRequest->id,
                    'object_name' => $objectData['object_name'],
                    'category_id' => $objectData['category_id'] ?? null,
                    'type_id' => $objectData['type_id'] ?? null,
                    'brand' => $objectData['brand'] ?? null,
                    'model' => $objectData['model'] ?? null,
                    'serial_number' => $objectData['serial_number'] ?? null,
                    'factory_number' => $objectData['factory_number'] ?? null,
                    'manufacture_year' => $objectData['manufacture_year'] ?? null,
                    'capacity' => $objectData['capacity'] ?? null,
                    'capacity_unit' => $objectData['capacity_unit'] ?? null,
                ]);
            }

            // Handle document uploads
            if (! empty($draft['previous_certificate_file'])) {
                $path = $draft['previous_certificate_file']->store('requests/.documents', 'public');
                $inspectionRequest->documents()->create([
                    'name' => 'Sertifikat Riksa Uji Sebelumnya',
                    'type' => 'request',
                    'file_path' => $path,
                    'file_name' => $draft['previous_certificate_file']->getClientOriginalName(),
                    'mime_type' => $draft['previous_certificate_file']->getMimeType(),
                    'file_size' => $draft['previous_certificate_file']->getSize(),
                ]);
            }

            // Handle step 6 document uploads
            if (! empty($draft['step6_files']) && is_array($draft['step6_files'])) {
                foreach ($draft['step6_files'] as $fileData) {
                    $inspectionRequest->documents()->create($fileData);
                }
            }

            return $inspectionRequest;
        });

        // Send emails
        try {
            Mail::to($request->applicant_email)->send(new CustomerRequestConfirmation($request));
            Mail::to(config('mail.to.address', config('CONTACT_EMAIL')))->send(new AdminNewRequestNotification($request));
        } catch (\Exception $e) {
            Log::error('Failed to send request emails: '.$e->getMessage());
        }

        // Clear draft from session
        Session::forget(self::SESSION_KEY);

        return redirect()->route('customer.requests.show', $request)
            ->with('success', 'Permohonan Riksa Uji berhasil dikirim! Nomor permohonan: '.$request->request_number);
    }
}
