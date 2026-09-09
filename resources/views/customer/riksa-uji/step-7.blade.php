{{-- Step 7: Review --}}
@php
    $objects = $draft['objects'] ?? [];
@endphp

<h2 class="text-lg font-bold text-[#06205E] mb-6">Review Permohonan</h2>

<div class="space-y-6">
    {{-- PEMOHON --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Pemohon</h3>
            <a href="{{ route('customer.requests.goToStep', 1) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Nama:</span> <span class="font-medium text-gray-800">{{ $draft['applicant_name'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Posisi:</span> <span class="font-medium text-gray-800">{{ $draft['applicant_position'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">WhatsApp:</span> <span class="font-medium text-gray-800">{{ $draft['applicant_phone'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Email:</span> <span class="font-medium text-gray-800">{{ $draft['applicant_email'] ?? '-' }}</span></div>
        </div>
    </div>

    {{-- PERUSAHAAN --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Perusahaan</h3>
            <a href="{{ route('customer.requests.goToStep', 2) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 grid grid-cols-2 gap-3 text-sm">
            <div class="col-span-2"><span class="text-gray-500">Nama:</span> <span class="font-medium text-gray-800">{{ $draft['company_name'] ?? '-' }}</span></div>
            <div class="col-span-2"><span class="text-gray-500">Alamat:</span> <span class="font-medium text-gray-800">{{ $draft['company_address'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Provinsi:</span> <span class="font-medium text-gray-800">{{ $draft['company_province'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Kota:</span> <span class="font-medium text-gray-800">{{ $draft['company_city'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Kecamatan:</span> <span class="font-medium text-gray-800">{{ $draft['company_district'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Kode Pos:</span> <span class="font-medium text-gray-800">{{ $draft['company_postal_code'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Telepon:</span> <span class="font-medium text-gray-800">{{ $draft['company_phone'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Email:</span> <span class="font-medium text-gray-800">{{ $draft['company_email'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">NIB:</span> <span class="font-medium text-gray-800">{{ $draft['company_nib'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">NPWP:</span> <span class="font-medium text-gray-800">{{ $draft['company_npwp'] ?? '-' }}</span></div>
        </div>
    </div>

    {{-- OBJEK K3 --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Objek K3</h3>
            <a href="{{ route('customer.requests.goToStep', 3) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 space-y-4">
            @forelse($objects as $idx => $obj)
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-xs font-bold text-[#0736AA] mb-3 uppercase">Objek {{ $idx + 1 }}</p>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div><span class="text-gray-500">Jenis:</span> <span class="font-medium text-gray-800">{{ $categories->where('id', $obj['category_id'])->first()->name ?? '-' }}</span></div>
                        <div><span class="text-gray-500">Spesifik:</span> <span class="font-medium text-gray-800">{{ collect($obj['types'] ?? [])->where('id', $obj['type_id'])->first()->name ?? '-' }}</span></div>
                        <div class="col-span-2"><span class="text-gray-500">Nama:</span> <span class="font-medium text-gray-800">{{ $obj['object_name'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">Merek:</span> <span class="font-medium text-gray-800">{{ $obj['brand'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">Tipe:</span> <span class="font-medium text-gray-800">{{ $obj['model'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">No. Seri:</span> <span class="font-medium text-gray-800">{{ $obj['serial_number'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">No. Pabrik:</span> <span class="font-medium text-gray-800">{{ $obj['factory_number'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">Tahun:</span> <span class="font-medium text-gray-800">{{ $obj['manufacture_year'] ?? '-' }}</span></div>
                        <div><span class="text-gray-500">Kapasitas:</span> <span class="font-medium text-gray-800">{{ ($obj['capacity'] ?? '') . ' ' . ($obj['capacity_unit'] ?? '') }}</span></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada objek ditambahkan.</p>
            @endforelse
        </div>
    </div>

    {{-- RIKSA UJI SEBELUMNYA --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Riksa Uji Sebelumnya</h3>
            <a href="{{ route('customer.requests.goToStep', 4) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 grid grid-cols-2 gap-3 text-sm">
            <div class="col-span-2"><span class="text-gray-500">Status:</span> <span class="font-medium text-gray-800">
                @if(($draft['has_previous_inspection'] ?? '') === '1') Sudah pernah
                @elseif(($draft['has_previous_inspection'] ?? '') === '0') Belum pernah
                @elseif(($draft['has_previous_inspection'] ?? '') === 'unknown') Tidak tahu
                @else - @endif
            </span></div>
            @if(($draft['has_previous_inspection'] ?? '') === '1')
                <div><span class="text-gray-500">No. Sertifikat:</span> <span class="font-medium text-gray-800">{{ $draft['previous_certificate_number'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">PJK3:</span> <span class="font-medium text-gray-800">{{ $draft['previous_pjk3'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Tgl. Pemeriksaan:</span> <span class="font-medium text-gray-800">{{ $draft['previous_inspection_date'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Tgl. Jatuh Tempo:</span> <span class="font-medium text-gray-800">{{ $draft['certificate_expiry_date'] ?? '-' }}</span></div>
            @endif
        </div>
    </div>

    {{-- LOKASI --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Lokasi Pemeriksaan</h3>
            <a href="{{ route('customer.requests.goToStep', 5) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 text-sm">
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2"><span class="text-gray-500">Alamat:</span> <span class="font-medium text-gray-800">{{ $draft['inspection_address'] ?? $draft['company_address'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Provinsi:</span> <span class="font-medium text-gray-800">{{ $draft['inspection_province'] ?? $draft['company_province'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Kota:</span> <span class="font-medium text-gray-800">{{ $draft['inspection_city'] ?? $draft['company_city'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Kecamatan:</span> <span class="font-medium text-gray-800">{{ $draft['inspection_district'] ?? $draft['company_district'] ?? '-' }}</span></div>
                <div><span class="text-gray-500">Kode Pos:</span> <span class="font-medium text-gray-800">{{ $draft['inspection_postal_code'] ?? $draft['company_postal_code'] ?? '-' }}</span></div>
                <div class="col-span-2"><span class="text-gray-500">Catatan:</span> <span class="font-medium text-gray-800">{{ $draft['location_notes'] ?? '-' }}</span></div>
            </div>
        </div>
    </div>

    {{-- DOKUMEN --}}
    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between bg-[#0736AA]/5 px-5 py-3 border-b border-gray-200">
            <h3 class="text-sm font-bold text-[#0736AA] uppercase tracking-wide">Dokumen</h3>
            <a href="{{ route('customer.requests.goToStep', 6) }}" class="text-xs font-semibold text-[#0736AA] hover:underline flex items-center gap-1">
                <svg data-lucide="pencil" class="w-3 h-3"></svg> Edit
            </a>
        </div>
        <div class="p-5 text-sm">
            <span class="text-gray-500">Dokumen telah diunggah.</span>
        </div>
    </div>
</div>

{{-- Consent --}}
<div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
    <label class="flex items-start gap-3 cursor-pointer">
        <input type="checkbox" name="consent" value="1" required
            class="w-4 h-4 mt-0.5 text-[#0736AA] focus:ring-[#0736AA]/20 border-gray-300 rounded">
        <span class="text-sm text-gray-700 leading-relaxed">
            Saya menyatakan data yang saya berikan adalah benar dan memahami bahwa permohonan ini akan ditinjau oleh tim NTU sebelum jadwal Riksa Uji dikonfirmasi.
        </span>
    </label>
    @error('consent')
        <p class="text-xs text-red-500 mt-2 ml-7">{{ $message }}</p>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
    });
</script>
