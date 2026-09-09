{{-- Step 6: Dokumen Pendukung --}}
<h2 class="text-lg font-bold text-[#06205E] mb-6">Dokumen Pendukung</h2>

<p class="text-sm text-gray-600 mb-6">Upload dokumen pendukung untuk mempercepat proses verifikasi. Format: JPG, JPEG, PNG, atau PDF. Maksimal 10 MB per file.</p>

<div class="space-y-5">
    {{-- Foto Objek --}}
    <div class="border border-gray-200 rounded-xl p-4 hover:border-[#0736AA]/30 transition-all">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#0736AA]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg data-lucide="camera" class="w-5 h-5 text-[#0736AA]"></svg>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-semibold text-[#06205E] mb-1">Foto Objek</label>
                <p class="text-xs text-gray-500 mb-2">Upload foto keseluruhan objek yang akan diperiksa.</p>
                <input type="file" name="photo_object"
                    accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#0736AA]/10 file:text-[#0736AA] hover:file:bg-[#0736AA]/20">
            </div>
        </div>
    </div>

    {{-- Foto Nameplate --}}
    <div class="border border-gray-200 rounded-xl p-4 hover:border-[#0736AA]/30 transition-all">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#0736AA]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg data-lucide="image" class="w-5 h-5 text-[#0736AA]"></svg>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-semibold text-[#06205E] mb-1">Foto Nameplate</label>
                <p class="text-xs text-gray-500 mb-2">Upload foto nameplate objek untuk membantu tim teknis melakukan verifikasi data peralatan.</p>
                <input type="file" name="photo_nameplate"
                    accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#0736AA]/10 file:text-[#0736AA] hover:file:bg-[#0736AA]/20">
            </div>
        </div>
    </div>

    {{-- Dokumen Pendukung Lainnya --}}
    <div class="border border-gray-200 rounded-xl p-4 hover:border-[#0736AA]/30 transition-all">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#0736AA]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg data-lucide="file-text" class="w-5 h-5 text-[#0736AA]"></svg>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-semibold text-[#06205E] mb-1">Dokumen Pendukung Lainnya</label>
                <p class="text-xs text-gray-500 mb-2">Upload dokumen pendukung lainnya (spesifikasi, manual book, dll).</p>
                <input type="file" name="supporting_documents[]"
                    accept=".jpg,.jpeg,.png,.pdf" multiple
                    class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#0736AA]/10 file:text-[#0736AA] hover:file:bg-[#0736AA]/20">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
    });
</script>
