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

    <h2 class="text-2xl font-bold text-secondary mb-1">Selamat Datang</h2>
    <p class="text-sm text-gray-500 mb-8">Masuk ke akun NTU Anda untuk melanjutkan.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-secondary mb-1.5">Email</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@perusahaan.com"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('email')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-secondary mb-1.5">Password</label>
            <div class="relative">
                <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="••••••••"
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

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-gray-600 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/30">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors">Lupa password?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full py-3.5 rounded-xl bg-primary text-white font-bold text-sm hover:bg-primary/90 shadow-lg shadow-primary/30 transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2">
            Masuk
            <i data-lucide="log-in" class="w-4 h-4"></i>
        </button>
    </form>
</x-auth-split>
