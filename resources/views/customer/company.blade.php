@extends('layouts.customer')

@section('title', 'Profil Perusahaan - NTU')

@section('content')
<div class="space-y-6">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('customer.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-secondary font-medium">Profil Perusahaan</span>
    </nav>

    <h1 class="text-2xl font-bold text-secondary">Profil Perusahaan</h1>

    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100">
            <div class="p-6">
                <h3 class="text-base font-bold text-secondary mb-5">Informasi Perusahaan</h3>
                <form method="POST" action="{{ route('customer.company.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="company_name">Nama Perusahaan</label>
                        <input type="text" id="company_name" name="company_name"
                               value="{{ old('company_name', Auth::user()->customerProfile?->company?->name ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                               placeholder="Masukkan nama perusahaan" required>
                        @error('company_name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="address">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                                  class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 resize-none"
                                  placeholder="Masukkan alamat lengkap">{{ old('address', Auth::user()->customerProfile?->company?->address ?? '') }}</textarea>
                        @error('address') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="province">Provinsi</label>
                            <input type="text" id="province" name="province"
                                   value="{{ old('province', Auth::user()->customerProfile?->company?->province ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Provinsi">
                            @error('province') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="city">Kota</label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city', Auth::user()->customerProfile?->company?->city ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Kota">
                            @error('city') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="district">Kecamatan</label>
                            <input type="text" id="district" name="district"
                                   value="{{ old('district', Auth::user()->customerProfile?->company?->district ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Kecamatan">
                            @error('district') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="postal_code">Kode Pos</label>
                            <input type="text" id="postal_code" name="postal_code"
                                   value="{{ old('postal_code', Auth::user()->customerProfile?->company?->postal_code ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Kode pos">
                            @error('postal_code') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="company_phone">Telepon</label>
                            <input type="text" id="company_phone" name="company_phone"
                                   value="{{ old('company_phone', Auth::user()->customerProfile?->company?->phone ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Nomor telepon perusahaan">
                            @error('company_phone') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="company_email">Email Perusahaan</label>
                        <input type="email" id="company_email" name="company_email"
                               value="{{ old('company_email', Auth::user()->customerProfile?->company?->email ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                               placeholder="Email perusahaan">
                        @error('company_email') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="nib">NIB <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <input type="text" id="nib" name="nib"
                                   value="{{ old('nib', Auth::user()->customerProfile?->company?->nib ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Nomor Induk Berusaha">
                            @error('nib') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="npwp">NPWP <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <input type="text" id="npwp" name="npwp"
                                   value="{{ old('npwp', Auth::user()->customerProfile?->company?->npwp ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700"
                                   placeholder="Nomor Pokok Wajib Pajak">
                            @error('npwp') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-xl hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
