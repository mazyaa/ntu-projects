{{-- Step 4: Riksa Uji Sebelumnya --}}
<h2 class="text-lg font-bold text-[#06205E] mb-6">Riksa Uji Sebelumnya</h2>

<div x-data="{ hasPrevious: '{{ old('has_previous_inspection', $draft['has_previous_inspection'] ?? '') }}' }">
    {{-- Radio Buttons --}}
    <div class="space-y-3 mb-6">
        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-[#0736AA]/30 hover:bg-[#0736AA]/5 transition-all cursor-pointer"
            :class="{ 'border-[#0736AA] bg-[#0736AA]/5': hasPrevious === 'yes' }">
            <input type="radio" name="has_previous_inspection" value="1" x-model="hasPrevious"
                class="w-4 h-4 text-[#0736AA] focus:ring-[#0736AA]/20 border-gray-300">
            <span class="text-sm font-medium text-gray-700">Sudah pernah dilakukan Riksa Uji</span>
        </label>

        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-[#0736AA]/30 hover:bg-[#0736AA]/5 transition-all cursor-pointer"
            :class="{ 'border-[#0736AA] bg-[#0736AA]/5': hasPrevious === 'no' }">
            <input type="radio" name="has_previous_inspection" value="0" x-model="hasPrevious"
                class="w-4 h-4 text-[#0736AA] focus:ring-[#0736AA]/20 border-gray-300">
            <span class="text-sm font-medium text-gray-700">Belum pernah dilakukan Riksa Uji</span>
        </label>

        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-[#0736AA]/30 hover:bg-[#0736AA]/5 transition-all cursor-pointer"
            :class="{ 'border-[#0736AA] bg-[#0736AA]/5': hasPrevious === 'unknown' }">
            <input type="radio" name="has_previous_inspection" value="unknown" x-model="hasPrevious"
                class="w-4 h-4 text-[#0736AA] focus:ring-[#0736AA]/20 border-gray-300">
            <span class="text-sm font-medium text-gray-700">Tidak tahu</span>
        </label>
    </div>

    {{-- Conditional Fields --}}
    <div x-show="hasPrevious === '1'" x-transition class="space-y-5 pt-4 border-t border-gray-100">
        <h3 class="text-sm font-semibold text-[#06205E]">Data Riksa Uji Sebelumnya</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Nomor Sertifikat --}}
            <div>
                <label for="previous_certificate_number" class="block text-sm font-semibold text-[#06205E] mb-1.5">Nomor Sertifikat</label>
                <input type="text" id="previous_certificate_number" name="previous_certificate_number"
                    value="{{ old('previous_certificate_number', $draft['previous_certificate_number'] ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                    placeholder="Nomor sertifikat sebelumnya">
            </div>

            {{-- PJK3 Sebelumnya --}}
            <div>
                <label for="previous_pjk3" class="block text-sm font-semibold text-[#06205E] mb-1.5">PJK3 Sebelumnya</label>
                <input type="text" id="previous_pjk3" name="previous_pjk3"
                    value="{{ old('previous_pjk3', $draft['previous_pjk3'] ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                    placeholder="Nama PJK3 sebelumnya">
            </div>

            {{-- Tanggal Pemeriksaan Terakhir --}}
            <div>
                <label for="previous_inspection_date" class="block text-sm font-semibold text-[#06205E] mb-1.5">Tanggal Pemeriksaan Terakhir</label>
                <input type="date" id="previous_inspection_date" name="previous_inspection_date"
                    value="{{ old('previous_inspection_date', $draft['previous_inspection_date'] ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4">
            </div>

            {{-- Tanggal Jatuh Tempo --}}
            <div>
                <label for="certificate_expiry_date" class="block text-sm font-semibold text-[#06205E] mb-1.5">Tanggal Jatuh Tempo Sertifikat</label>
                <input type="date" id="certificate_expiry_date" name="certificate_expiry_date"
                    value="{{ old('certificate_expiry_date', $draft['certificate_expiry_date'] ?? '') }}"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4">
            </div>
        </div>

        {{-- Upload Sertifikat --}}
        <div>
            <label class="block text-sm font-semibold text-[#06205E] mb-1.5">Upload Sertifikat Sebelumnya</label>
            <p class="text-xs text-gray-500 mb-2">Format: JPG, JPEG, PNG, atau PDF. Maksimal 10 MB.</p>
            <input type="file" name="previous_certificate_file"
                accept=".jpg,.jpeg,.png,.pdf"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#0736AA]/10 file:text-[#0736AA] hover:file:bg-[#0736AA]/20">
        </div>
    </div>
</div>
