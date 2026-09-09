<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InspectionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InspectionRequestController extends Controller
{
    public function index(Request $request): View
    {
        $query = InspectionRequest::with(['user', 'company', 'objects']);

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                    ->orWhere('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($status = $request->input('status')) {
            $query->status($status);
        }

        $requests = $query->orderByDesc('submitted_at')->paginate(15);

        return view('admin.riksa-uji.requests.index', [
            'requests' => $requests,
            'statuses' => $this->getStatuses(),
        ]);
    }

    public function show(InspectionRequest $inspectionRequest): View
    {
        $inspectionRequest->load([
            'user',
            'company',
            'objects.category',
            'objects.type',
            'notes.user',
            'documents',
        ]);

        return view('admin.riksa-uji.requests.show', [
            'request' => $inspectionRequest,
            'statuses' => $this->getStatuses(),
        ]);
    }

    public function updateStatus(Request $request, InspectionRequest $inspectionRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:'.implode(',', array_keys($this->getStatuses()))],
        ]);

        $inspectionRequest->update(['status' => $validated['status']]);

        return back()->with('status', 'Status permohonan berhasil diperbarui.');
    }

    public function storeNote(Request $request, InspectionRequest $inspectionRequest): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string'],
        ]);

        $inspectionRequest->notes()->create([
            'user_id' => auth()->id(),
            'note' => $validated['note'],
        ]);

        return back()->with('status', 'Catatan berhasil ditambahkan.');
    }

    private function getStatuses(): array
    {
        return [
            'new' => 'Baru',
            'reviewing' => 'Sedang Ditinjau',
            'contacted' => 'Sudah Dihubungi',
            'quotation_sent' => 'Kutipan Harga Terkirim',
            'approved' => 'Disetujui',
            'scheduled' => 'Terjadwal',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    }
}
