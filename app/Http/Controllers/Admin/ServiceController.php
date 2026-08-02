<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::latest('sort_order')->latest();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $services = $query->paginate(15)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateService($request);

        $service = Service::create([
            'slug' => Str::slug($request->input('title')),
            'title' => $validated['title'],
            'short_title' => $validated['short_title'] ?? null,
            'image' => $validated['image'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'color' => $validated['color'] ?? 'primary',
            'tagline' => $validated['tagline'] ?? null,
            'description' => $validated['description'] ?? null,
            'service_items' => $this->normalizeServiceItems($validated['service_items'] ?? []),
            'status' => $validated['status'] ?? 'active',
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('services.index'))->with('success', 'Layanan berhasil dibuat.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validateService($request);

        $service->update([
            'title' => $validated['title'],
            'slug' => Str::slug($request->input('title')),
            'short_title' => $validated['short_title'] ?? null,
            'image' => $validated['image'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'color' => $validated['color'] ?? 'primary',
            'tagline' => $validated['tagline'] ?? null,
            'description' => $validated['description'] ?? null,
            'service_items' => $this->normalizeServiceItems($validated['service_items'] ?? []),
            'status' => $validated['status'] ?? 'active',
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect(panel_route('services.index'))->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect(panel_route('services.index'))->with('success', 'Layanan berhasil dihapus.');
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'in:primary,secondary,accent,success,warning,danger'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'service_items' => ['nullable', 'array'],
            'service_items.*' => ['string', 'max:1000'],
            'status' => ['required', 'in:active,draft,archived'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function normalizeServiceItems(array $items): array
    {
        return array_values(array_filter(array_map('trim', $items)));
    }
}
