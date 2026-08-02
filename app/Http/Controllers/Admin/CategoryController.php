<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('articles')->orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string', 'max:500'],
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'name_en' => $validated['name_en'] ?? null,
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$category->getKey()],
            'name_en' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string', 'max:500'],
        ]);

        $category->update([
            'name' => $validated['name'],
            'name_en' => $validated['name_en'] ?? null,
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki artikel dan tidak dapat dihapus.');
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
