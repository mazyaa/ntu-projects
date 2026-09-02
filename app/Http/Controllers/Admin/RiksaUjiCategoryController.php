<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiksaUjiCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RiksaUjiCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = RiksaUjiCategory::with('types');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $categories = $query->orderBy('sort_order')->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.riksa-uji-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.riksa-uji-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        RiksaUjiCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
        ]);

        return redirect(panel_route('riksa-uji-categories.index'))->with('success', 'Kategori Riksa Uji berhasil dibuat.');
    }

    public function edit(RiksaUjiCategory $riksaUjiCategory): View
    {
        $riksaUjiCategory->load('types');

        return view('admin.riksa-uji-categories.edit', ['category' => $riksaUjiCategory]);
    }

    public function update(Request $request, RiksaUjiCategory $riksaUjiCategory): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        $riksaUjiCategory->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            'name_en' => $validated['name_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
        ]);

        return redirect(panel_route('riksa-uji-categories.index'))->with('success', 'Kategori Riksa Uji berhasil diperbarui.');
    }

    public function destroy(RiksaUjiCategory $riksaUjiCategory): RedirectResponse
    {
        $riksaUjiCategory->delete();

        return redirect(panel_route('riksa-uji-categories.index'))->with('success', 'Kategori Riksa Uji berhasil dihapus.');
    }

    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
