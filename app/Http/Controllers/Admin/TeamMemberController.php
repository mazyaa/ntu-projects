<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\TeamMember;
use App\Services\ImageOptimizerService;
use App\Services\UploadSecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function __construct(
        private UploadSecurityService $uploadSecurity,
        private ImageOptimizerService $imageOptimizer,
    ) {}

    public function index(Request $request): View
    {
        $query = TeamMember::with('skills');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $members = $query->orderBy('sort_order')->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.team.index', compact('members'));
    }

    public function create(): View
    {
        $skills = Skill::orderBy('name')->get();

        return view('admin.team.create', compact('skills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMember($request);

        $member = TeamMember::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'position' => $validated['position'] ?? null,
            'position_en' => $validated['position_en'] ?? null,
            'short_bio' => $validated['short_bio'] ?? null,
            'short_bio_en' => $validated['short_bio_en'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'bio_en' => $validated['bio_en'] ?? null,
            'photo' => $validated['photo'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        if ($request->has('skills')) {
            $member->skills()->sync($request->input('skills', []));
        }

        return redirect(panel_route('team.index'))->with('success', 'Anggota tim berhasil dibuat.');
    }

    public function edit(TeamMember $teamMember): View
    {
        $teamMember->load('skills');
        $skills = Skill::orderBy('name')->get();

        return view('admin.team.edit', ['member' => $teamMember, 'skills' => $skills]);
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $this->validateMember($request);

        $teamMember->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'position' => $validated['position'] ?? null,
            'position_en' => $validated['position_en'] ?? null,
            'short_bio' => $validated['short_bio'] ?? null,
            'short_bio_en' => $validated['short_bio_en'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'bio_en' => $validated['bio_en'] ?? null,
            'photo' => $validated['photo'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        $teamMember->skills()->sync($request->input('skills', []));

        return redirect(panel_route('team.index'))->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->skills()->detach();
        $teamMember->delete();

        return redirect(panel_route('team.index'))->with('success', 'Anggota tim berhasil dihapus.');
    }

    public function uploadPhoto(Request $request): JsonResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file = $request->file('photo');

        if (! $this->uploadSecurity->validate($file, ['image/jpeg', 'image/png', 'image/webp'])) {
            return response()->json(['error' => 'File type not allowed.'], 422);
        }

        $path = $file->store('team', 'public');
        $optimized = $this->imageOptimizer->optimizeStored('public', $path);

        if ($optimized) {
            $path = $optimized['path'];
        }

        return response()->json(['url' => asset('storage/'.$path), 'path' => $path]);
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'position_en' => ['nullable', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string'],
            'short_bio_en' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'photo' => ['nullable', 'string', 'max:500'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
