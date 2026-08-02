<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with('roles')->latest();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => Role::query()->where('guard_name', 'web')->orderBy('name')->get(),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $user->syncRoles([$request->input('role')]);

            return $user;
        });

        return redirect(panel_route('users.index'))->with('success', 'Pengguna berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user->load('roles'),
            'roles' => Role::query()->where('guard_name', 'web')->orderBy('name')->get(),
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->preventSelfLockout($user);

        DB::transaction(function () use ($request, $user) {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ];

            if ($request->filled('password')) {
                $data['password'] = $request->input('password');
            }

            $user->update($data);
            $user->syncRoles([$request->input('role')]);
        });

        return redirect(panel_route('users.index'))->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->getKey() === auth()->id(), 422, 'Anda tidak dapat menghapus akun Anda sendiri.');

        $user->delete();

        return redirect(panel_route('users.index'))->with('success', 'Pengguna berhasil dihapus.');
    }

    private function preventSelfLockout(User $user): void
    {
        if ($user->getKey() !== auth()->id()) {
            return;
        }

        $currentRole = $user->roles()->value('name');

        abort_if(
            $currentRole === 'Super Admin' && request()->input('role') !== 'Super Admin',
            422,
            'Anda tidak dapat mengubah role akun Super Admin Anda sendiri.',
        );
    }
}
