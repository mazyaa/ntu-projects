<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Services\ImageOptimizerService;
use App\Services\UploadSecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    public function __construct(
        private UploadSecurityService $uploadSecurity,
        private ImageOptimizerService $imageOptimizer,
    ) {}

    public function index(Request $request): View
    {
        $query = Equipment::query();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $equipment = $query->orderBy('sort_order')->orderBy('name')->paginate(15)->withQueryString();
        $categories = Equipment::distinct()->pluck('category')->filter()->values();

        return view('admin.equipment.index', compact('equipment', 'categories'));
    }

    public function create(): View
    {
        return view('admin.equipment.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEquipment($request);

        Equipment::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category' => $validated['category'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'model' => $validated['model'] ?? null,
            'capacity' => $validated['capacity'] ?? null,
            'unit' => $validated['unit'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('equipment.index'))->with('success', 'Equipment berhasil dibuat.');
    }

    public function edit(Equipment $equipment): View
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment): RedirectResponse
    {
        $validated = $this->validateEquipment($request);

        $equipment->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'category' => $validated['category'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'model' => $validated['model'] ?? null,
            'capacity' => $validated['capacity'] ?? null,
            'unit' => $validated['unit'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('equipment.index'))->with('success', 'Equipment berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        $equipment->delete();

        return redirect(panel_route('equipment.index'))->with('success', 'Equipment berhasil dihapus.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file = $request->file('image');

        if (! $this->uploadSecurity->validate($file, ['image/jpeg', 'image/png', 'image/webp'])) {
            return response()->json(['error' => 'File type not allowed.'], 422);
        }

        $path = $file->store('equipment', 'public');
        $optimized = $this->imageOptimizer->optimizeStored('public', $path);

        if ($optimized) {
            $path = $optimized['path'];
        }

        return response()->json(['url' => asset('storage/'.$path), 'path' => $path]);
    }

    private function validateEquipment(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'brand' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'capacity' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
