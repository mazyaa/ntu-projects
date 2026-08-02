<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadSecurityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UploadSecurityService $uploadSecurity,
    ) {}

    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'skills' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = $request->user();

        $data = [
            'name' => $request->input('name'),
            'skills' => $request->input('skills'),
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            if (! $this->uploadSecurity->validate($file, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
                return back()->with('error', 'Tipe gambar tidak diizinkan. Gunakan JPG, PNG, WEBP, atau GIF.');
            }

            $path = $file->store('avatars', 'public');

            if ($user->avatar) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
            }

            $data['avatar'] = asset('storage/'.$path);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
