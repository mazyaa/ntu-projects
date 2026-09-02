<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ImageOptimizerService;
use App\Services\UploadSecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(
        private UploadSecurityService $uploadSecurity,
        private ImageOptimizerService $imageOptimizer,
    ) {}

    public function index(Request $request): View
    {
        $query = Project::query();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->input('status') === 'published');
        }

        $projects = $query->orderBy('sort_order')->orderBy('year', 'desc')->paginate(15)->withQueryString();
        $years = Project::distinct()->pluck('year')->filter()->values()->sortDesc();

        return view('admin.projects.index', compact('projects', 'years'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProject($request);

        Project::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'year' => $validated['year'] ?? null,
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_published' => $validated['is_published'] ?? false,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('projects.index'))->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validateProject($request);

        $project->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'year' => $validated['year'] ?? null,
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_published' => $validated['is_published'] ?? false,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('projects.index'))->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect(panel_route('projects.index'))->with('success', 'Proyek berhasil dihapus.');
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

        $path = $file->store('projects', 'public');
        $optimized = $this->imageOptimizer->optimizeStored('public', $path);

        if ($optimized) {
            $path = $optimized['path'];
        }

        return response()->json(['url' => asset('storage/'.$path), 'path' => $path]);
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:4'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
