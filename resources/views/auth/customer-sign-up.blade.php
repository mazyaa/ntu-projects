<x-auth-split>
    <!-- Logo (mobile) -->
    <div class="flex justify-center lg:hidden mb-8">
        <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-14 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
    </div>

    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-primary transition-colors group mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
        Kembali ke Beranda
    </a>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-secondary mb-1">Buat Akun Baru</h2>
    <p class="text-sm text-gray-500 mb-8">Daftar untuk memulai menggunakan layanan NTU.</p>

    <form method="POST" action="{{ route('customer.register') }}" class="space-y-5">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-sm font-semibold text-secondary mb-1.5">Nama Lengkap</label>
            <div class="relative">
                <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('name')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-secondary mb-1.5">Email</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@perusahaan.com"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('email')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- No. WhatsApp -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-secondary mb-1.5">No. WhatsApp</label>
            <div class="relative">
                <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel" placeholder="08xxxxxxxxxx"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('phone')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-secondary mb-1.5">Password</label>
            <div class="relative">
                <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" placeholder="••••••••"
                    class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors" aria-label="Tampilkan atau sembunyikan password">
                    <i data-lucide="eye" class="w-5 h-5" x-show="!show"></i>
                    <i data-lucide="eye-off" class="w-5 h-5" x-show="show" style="display: none;"></i>
                </button>
            </div>
            @error('password')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-semibold text-secondary mb-1.5">Konfirmasi Password</label>
            <div class="relative">
                <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                    class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors" aria-label="Tampilkan atau sembunyikan password">
                    <i data-lucide="eye" class="w-5 h-5" x-show="!show"></i>
                    <i data-lucide="eye-off" class="w-5 h-5" x-show="show" style="display: none;"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nama Perusahaan (optional) -->
        <div>
            <label for="company_name" class="block text-sm font-semibold text-secondary mb-1.5">Nama Perusahaan <span class="text-gray-400 font-normal">(opsional)</span></label>
            <div class="relative">
                <i data-lucide="building-2" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}" autocomplete="organization" placeholder="PT Nusantara Teknologi"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('company_name')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full py-3.5 rounded-xl bg-primary text-white font-bold text-sm hover:bg-primary/90 shadow-lg shadow-primary/30 transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2">
            Buat Akun
            <i data-lucide="user-plus" class="w-4 h-4"></i>
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="bg-white px-4 text-gray-400">atau</span>
        </div>
    </div>

    <!-- Google OAuth -->
    <a href="{{ route('customer.google.redirect') }}" class="w-full py-3.5 rounded-xl border border-gray-300 bg-white text-secondary font-bold text-sm hover:bg-gray-50 shadow-sm transition-all duration-300 flex items-center justify-center gap-3">
        <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Lanjutkan dengan Google
    </a>

    <!-- Register link -->
    <p class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('customer.login') }}" class="font-semibold text-primary hover:text-primary/80 transition-colors">Masuk</a>
    </p>
</x-auth-split>
