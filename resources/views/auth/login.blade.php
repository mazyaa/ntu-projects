<x-auth-split>
    <!-- Logo (mobile) -->
    <div class="flex justify-center lg:hidden mb-8">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
                <i data-lucide="shield-check" class="w-6 h-6 text-white"></i>
            </div>
            <span class="text-xl font-bold text-secondary">NTU Admin</span>
        </div>
    </div>

    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-primary transition-colors group mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
        Kembali ke Beranda
    </a>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if(session('toast'))
        <div class="mb-4 p-3 rounded-xl text-sm font-medium
            {{ session('toast.type') === 'error' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
            {{ session('toast.message') }}
        </div>
    @endif

    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
            <i data-lucide="shield-check" class="w-5 h-5 text-primary"></i>
        </div>
        <h2 class="text-2xl font-bold text-secondary">Panel Admin</h2>
    </div>
    <p class="text-sm text-gray-500 mb-8">Masuk ke panel administrasi NTU.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-secondary mb-1.5">Email</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@nusantara.co.id"
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
            Masuk ke Panel Admin
            <i data-lucide="log-in" class="w-4 h-4"></i>
        </button>
    </form>

    <!-- Customer login link -->
    <p class="text-center text-sm text-gray-500 mt-6">
        Login sebagai customer?
        <a href="{{ route('customer.login') }}" class="font-semibold text-primary hover:text-primary/80 transition-colors">Klik di sini</a>
    </p>
</x-auth-split>
