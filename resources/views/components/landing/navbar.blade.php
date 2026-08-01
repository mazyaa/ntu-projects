@php
    $navItems = [
        ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Tentang Kami', 'route' => 'about', 'active' => request()->routeIs('about')],
        ['label' => 'Layanan', 'route' => 'services.index', 'active' => request()->routeIs('services.*')],
        ['label' => 'Tim Kami', 'route' => 'leadership', 'active' => request()->routeIs('leadership*')],
        ['label' => 'Riset', 'route' => 'research', 'active' => request()->routeIs('research')],
        ['label' => 'Artikel', 'route' => 'articles', 'active' => request()->routeIs('articles*')],
    ];
@endphp

<header x-data="{
        scrolled: false,
        mobileMenuOpen: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            }, { passive: true });
        }
    }"
    class="fixed top-0 inset-x-0 z-50 w-full backdrop-blur-md"
    data-aos="fade-down" data-aos-duration="1000">

    <div class="absolute inset-0 bg-white transition-opacity duration-500"
         :class="scrolled ? 'opacity-80 shadow-sm border-b border-gray-100' : 'opacity-0 border-b border-transparent'"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 transition-all duration-300"
         :class="scrolled ? 'py-3' : 'py-5'">
        <nav class="flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="relative flex items-center group shrink-0" aria-label="Beranda {{ config('company.short_name') }}">
                <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-14 lg:h-16 w-auto transition-all duration-300 group-hover:scale-105" :class="scrolled ? 'opacity-100' : 'opacity-0'" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
                <img src="{{ asset('images/logo/footer-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="absolute left-0 top-1/2 -translate-y-1/2 h-10 lg:h-12 w-auto transition-all duration-300 group-hover:scale-105 brightness-0 invert" :class="scrolled ? 'opacity-0' : 'opacity-100'" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
            </a>

            <div class="hidden md:flex items-center gap-6 lg:gap-7">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="nav-link {{ $item['active'] ? 'active' : '' }}" :class="scrolled ? '' : 'nav-light'">
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ config('company.contact.email') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-primary rounded-full hover:bg-primary/90 transition-all duration-300 hover:shadow-lg hover:shadow-primary/30 transform hover:-translate-y-0.5">
                    Hubungi Kami
                </a>
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 -mr-2 transition-colors" :class="scrolled ? 'text-gray-600 hover:text-primary' : 'text-white hover:text-white/80'" aria-label="Buka menu">
                <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" style="display: none;"></i>
            </button>
        </nav>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="absolute top-full left-0 w-full bg-white border-b border-gray-100 shadow-xl md:hidden"
         style="display: none;">
        <div class="px-6 py-4 space-y-4 flex flex-col">
            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}" @click="mobileMenuOpen = false"
                   class="nav-link {{ $item['active'] ? 'active' : '' }} w-fit text-base font-medium text-gray-700">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <hr class="border-gray-100">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ config('company.contact.email') }}" target="_blank" rel="noopener" @click="mobileMenuOpen = false" class="inline-flex items-center justify-center w-full px-5 py-3 text-base font-semibold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all">
                Hubungi Kami
            </a>
        </div>
    </div>
</header>
