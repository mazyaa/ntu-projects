{{-- Step 8: Selesai --}}
<div class="text-center py-8">
    {{-- Success Icon --}}
    <div class="w-20 h-20 rounded-full bg-[#0B9918]/10 flex items-center justify-center mx-auto mb-6">
        <svg data-lucide="check-circle" class="w-12 h-12 text-[#0B9918]"></svg>
    </div>

    <h2 class="text-xl font-bold text-[#06205E] mb-3">Permohonan Berhasil Dikirim!</h2>

    @if(session('request_number') || ($draft['request_number'] ?? null))
        <p class="text-sm text-gray-500 mb-2">Nomor Permohonan</p>
        <p class="text-lg font-bold text-[#0736AA] tracking-wider mb-4">
            {{ session('request_number', $draft['request_number'] ?? '-') }}
        </p>
    @endif

    <p class="text-sm text-gray-600 max-w-md mx-auto mb-8 leading-relaxed">
        Tim NTU akan melakukan verifikasi data dan menghubungi Anda untuk proses selanjutnya.
    </p>

    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('customer.requests') }}"
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#0736AA] text-white hover:bg-[#06205E] transition-all text-sm font-semibold shadow-sm">
            <svg data-lucide="file-text" class="w-4 h-4"></svg>
            Lihat Permohonan
        </a>
        <a href="{{ route('customer.dashboard') }}"
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all text-sm font-medium">
            <svg data-lucide="home" class="w-4 h-4"></svg>
            Kembali ke Dashboard
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
    });
</script>
