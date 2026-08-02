<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(Request $request): View
    {
        $query = Tag::withCount('articles')->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $tags = $query->paginate(20)->withQueryString();

        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        $tag = Tag::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return back()->with('success', 'Tag berhasil ditambahkan.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return back()->with('success', 'Tag berhasil dihapus.');
    }
}
