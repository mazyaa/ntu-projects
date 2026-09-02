<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Page::query();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $pages = $query->orderBy('title')->paginate(15)->withQueryString();

        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePage($request);

        Page::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?: Str::slug($validated['title']),
            'content' => $validated['content'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'status' => $validated['status'] ?? 'published',
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
        ]);

        return redirect(panel_route('pages.index'))->with('success', 'Halaman berhasil dibuat.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validatePage($request);

        $page->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?: Str::slug($validated['title']),
            'content' => $validated['content'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'status' => $validated['status'] ?? 'published',
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
        ]);

        return redirect(panel_route('pages.index'))->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect(panel_route('pages.index'))->with('success', 'Halaman berhasil dihapus.');
    }

    private function validatePage(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:pages,slug,'.$request->route('page')?->getKey()],
            'content' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'content_en' => ['nullable', 'string'],
            'status' => ['required', 'in:published,draft'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
