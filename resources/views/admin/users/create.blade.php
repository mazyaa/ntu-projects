@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tambah Pengguna" subtitle="Buat akun pengguna baru dan tetapkan peran (role)." back="{{ panel_route('users.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6 max-w-2xl">
            <form method="POST" action="{{ panel_route('users.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Nama pengguna...">
                    @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="email@example.com">
                    @error('email') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="role">Role</label>
                    <select id="role" name="role" required
                            class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="password">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Minimal 8 karakter">
                        @error('password') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Ulangi password">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ panel_route('users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </x-card>
@endsection
