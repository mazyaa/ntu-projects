<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiksaUjiCategory;
use App\Models\RiksaUjiType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RiksaUjiTypeController extends Controller
{
    public function index(Request $request): View
    {
        $query = RiksaUjiType::with('category');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $types = $query->orderBy('sort_order')->orderBy('name')->paginate(15)->withQueryString();
        $categories = RiksaUjiCategory::orderBy('name')->get();

        return view('admin.riksa-uji-types.index', compact('types', 'categories'));
    }

    public function create(): View
    {
        $categories = RiksaUjiCategory::orderBy('name')->get();

        return view('admin.riksa-uji-types.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateType($request);

        RiksaUjiType::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('riksa-uji-types.index'))->with('success', 'Tipe Riksa Uji berhasil dibuat.');
    }

    public function edit(RiksaUjiType $riksaUjiType): View
    {
        $categories = RiksaUjiCategory::orderBy('name')->get();

        return view('admin.riksa-uji-types.edit', ['type' => $riksaUjiType, 'categories' => $categories]);
    }

    public function update(Request $request, RiksaUjiType $riksaUjiType): RedirectResponse
    {
        $validated = $this->validateType($request);

        $riksaUjiType->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('riksa-uji-types.index'))->with('success', 'Tipe Riksa Uji berhasil diperbarui.');
    }

    public function destroy(RiksaUjiType $riksaUjiType): RedirectResponse
    {
        $riksaUjiType->delete();

        return redirect(panel_route('riksa-uji-types.index'))->with('success', 'Tipe Riksa Uji berhasil dihapus.');
    }

    private function validateType(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:riksa_uji_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
