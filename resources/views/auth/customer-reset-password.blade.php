<x-auth-split>
    <!-- Logo (mobile) -->
    <div class="flex justify-center lg:hidden mb-8">
        <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-14 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
    </div>

    <a href="{{ route('customer.login') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-primary transition-colors group mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
        Kembali ke masuk
    </a>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-secondary mb-1">Reset Password</h2>
    <p class="text-sm text-gray-500 mb-8">Masukkan password baru Anda di bawah ini.</p>

    <form method="POST" action="{{ route('customer.password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-secondary mb-1.5">Email</label>
            <div class="relative">
                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input id="email" type="email" name="email" value="{{ $request->email ?? old('email') }}" required readonly autocomplete="username" placeholder="nama@perusahaan.com"
                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm" />
            </div>
            @error('email')
                <p class="text-sm text-danger mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-secondary mb-1.5">Password Baru</label>
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

        <!-- Submit -->
        <button type="submit" class="w-full py-3.5 rounded-xl bg-primary text-white font-bold text-sm hover:bg-primary/90 shadow-lg shadow-primary/30 transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2">
            Reset Password
            <i data-lucide="key-round" class="w-4 h-4"></i>
        </button>
    </form>
</x-auth-split>
