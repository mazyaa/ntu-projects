<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-primary/5 border border-white/60 p-8 text-center">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-14 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
                </div>

                <!-- Icon -->
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary/10 mb-6">
                    <i data-lucide="mail-check" class="w-8 h-8 text-primary"></i>
                </div>

                <h2 class="text-2xl font-bold text-secondary mb-2">Verifikasi Email Anda</h2>
                <p class="text-sm text-gray-500 mb-6">
                    Kami telah mengirimkan link verifikasi ke alamat email Anda. Silakan buka email Anda dan klik link tersebut untuk mengaktifkan akun.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Resend verification -->
                <form method="POST" action="{{ route('customer.verification.resend') }}" class="mb-4">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors">
                        Kirim ulang email verifikasi
                    </button>
                </form>

                <!-- Back to home -->
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-primary transition-colors group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke beranda
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
