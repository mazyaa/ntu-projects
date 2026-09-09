{{-- Step 5: Lokasi Pemeriksaan --}}
@php
    $company = $user->customerProfile->company ?? null;
@endphp

<h2 class="text-lg font-bold text-[#06205E] mb-6">Lokasi Pemeriksaan</h2>

<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Alamat Pemeriksaan --}}
        <div class="md:col-span-2">
            <label for="inspection_address" class="block text-sm font-semibold text-[#06205E] mb-1.5">Alamat Pemeriksaan</label>
            <textarea id="inspection_address" name="inspection_address" rows="3"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 resize-none"
                placeholder="Masukkan alamat lokasi pemeriksaan">{{ old('inspection_address', $draft['inspection_address'] ?? $draft['company_address'] ?? $company->address ?? '') }}</textarea>
        </div>

        {{-- Provinsi --}}
        <div>
            <label for="inspection_province" class="block text-sm font-semibold text-[#06205E] mb-1.5">Provinsi</label>
            <input type="text" id="inspection_province" name="inspection_province"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Jawa Barat"
                value="{{ old('inspection_province', $draft['inspection_province'] ?? $draft['company_province'] ?? $company->province ?? '') }}">
        </div>

        {{-- Kota/Kabupaten --}}
        <div>
            <label for="inspection_city" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kota / Kabupaten</label>
            <input type="text" id="inspection_city" name="inspection_city"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Bandung"
                value="{{ old('inspection_city', $draft['inspection_city'] ?? $draft['company_city'] ?? $company->city ?? '') }}">
        </div>

        {{-- Kecamatan --}}
        <div>
            <label for="inspection_district" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kecamatan</label>
            <input type="text" id="inspection_district" name="inspection_district"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Coblong"
                value="{{ old('inspection_district', $draft['inspection_district'] ?? $draft['company_district'] ?? $company->district ?? '') }}">
        </div>

        {{-- Kode Pos --}}
        <div>
            <label for="inspection_postal_code" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kode Pos</label>
            <input type="text" id="inspection_postal_code" name="inspection_postal_code"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: 40132"
                value="{{ old('inspection_postal_code', $draft['inspection_postal_code'] ?? $draft['company_postal_code'] ?? $company->postal_code ?? '') }}">
        </div>
    </div>

    {{-- Catatan Lokasi --}}
    <div>
        <label for="location_notes" class="block text-sm font-semibold text-[#06205E] mb-1.5">Catatan Lokasi</label>
        <textarea id="location_notes" name="location_notes" rows="2"
            class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 resize-none"
            placeholder="Contoh: Masuk dari jalan utama, gedung berwarna biru di sebelah pom bensin">{{ old('location_notes', $draft['location_notes'] ?? '') }}</textarea>
    </div>
</div>
