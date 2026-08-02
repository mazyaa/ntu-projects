@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Edit Pengguna" subtitle="Perbarui data, peran, dan password pengguna." back="{{ panel_route('users.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <!-- Informasi & Role -->
        <x-card>
            <div class="p-6">
                <h3 class="text-base font-bold text-secondary mb-5">Informasi Pengguna</h3>
                <form method="POST" action="{{ panel_route('users.update', $user) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        @error('email') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="role">Role</label>
                        <select id="role" name="role" required
                                class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        @if($user->getKey() === auth()->id())
                            <p class="text-xs text-gray-400 mt-1">Anda tidak dapat mengubah role akun Super Admin Anda sendiri.</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="password">Password Baru <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <input type="password" id="password" name="password"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Kosongkan jika tidak diubah">
                            @error('password') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <a href="{{ panel_route('users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>
@endsection
