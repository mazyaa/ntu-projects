{{-- Step 1: Data Pemohon --}}
<h2 class="text-lg font-bold text-[#06205E] mb-6">Data Pemohon</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    {{-- Nama Lengkap --}}
    <div>
        <label for="applicant_name" class="block text-sm font-semibold text-[#06205E] mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
        <div class="relative">
            <input type="text" id="applicant_name" name="applicant_name"
                value="{{ old('applicant_name', $draft['applicant_name'] ?? $user->name) }}"
                required
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Masukkan nama lengkap">
        </div>
        @error('applicant_name')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Posisi/Jabatan --}}
    <div>
        <label for="applicant_position" class="block text-sm font-semibold text-[#06205E] mb-1.5">Posisi / Jabatan</label>
        <input type="text" id="applicant_position" name="applicant_position"
            value="{{ old('applicant_position', $draft['applicant_position'] ?? $user->customerProfile?->job_title ?? '') }}"
            class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
            placeholder="Masukkan posisi atau jabatan">
    </div>

    {{-- No. WhatsApp --}}
    <div>
        <label for="applicant_phone" class="block text-sm font-semibold text-[#06205E] mb-1.5">No. WhatsApp <span class="text-red-500">*</span></label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg data-lucide="phone" class="w-4 h-4"></svg>
            </span>
            <input type="tel" id="applicant_phone" name="applicant_phone"
                value="{{ old('applicant_phone', $draft['applicant_phone'] ?? $user->customerProfile?->phone ?? '') }}"
                required
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 pl-10 pr-4"
                placeholder="08xxxxxxxxxx">
        </div>
        @error('applicant_phone')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="applicant_email" class="block text-sm font-semibold text-[#06205E] mb-1.5">Email <span class="text-red-500">*</span></label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg data-lucide="mail" class="w-4 h-4"></svg>
            </span>
            <input type="email" id="applicant_email" name="applicant_email"
                value="{{ old('applicant_email', $draft['applicant_email'] ?? $user->email ?? '') }}"
                required
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 pl-10 pr-4"
                placeholder="email@perusahaan.com">
        </div>
        @error('applicant_email')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
