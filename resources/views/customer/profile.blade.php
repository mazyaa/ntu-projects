@extends('layouts.customer')

@section('title', 'Profil Saya - NTU')

@section('content')
<div class="space-y-6">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('customer.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-secondary font-medium">Profil Saya</span>
    </nav>

    <h1 class="text-2xl font-bold text-secondary">Profil Saya</h1>

    <div class="grid grid-cols-1 gap-6">
        {{-- Profile Form --}}
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100">
            <div class="p-6">
                <h3 class="text-base font-bold text-secondary mb-5">Informasi Profil</h3>
                <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', Auth::user()->name) }}" readonly disabled
                                   class="w-full py-2.5 px-4 text-sm bg-gray-100 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed">
                            @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="email">Email</label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email', Auth::user()->email) }}" readonly disabled
                                   class="w-full py-2.5 px-4 text-sm bg-gray-100 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed">
                            @error('email') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="phone">No. Telepon</label>
                            <input type="text" id="phone" name="phone"
                                   value="{{ old('phone', Auth::user()->customerProfile?->phone ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Masukkan nomor telepon">
                            @error('phone') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="job_title">Jabatan</label>
                            <input type="text" id="job_title" name="job_title"
                                   value="{{ old('job_title', Auth::user()->customerProfile?->job_title ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Masukkan jabatan">
                            @error('job_title') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="avatar">Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                        @error('avatar') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-xl hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Password Change --}}
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100">
            <div class="p-6">
                <h3 class="text-base font-bold text-secondary mb-5">Ubah Password</h3>
                <form method="POST" action="{{ route('customer.profile.password') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="current_password">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                               placeholder="Masukkan password saat ini">
                        @error('current_password') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="password">Password Baru</label>
                            <input type="password" id="password" name="password"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Masukkan password baru">
                            @error('password') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-secondary rounded-xl hover:bg-secondary/90 transition-colors shadow-sm shadow-secondary/20">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
