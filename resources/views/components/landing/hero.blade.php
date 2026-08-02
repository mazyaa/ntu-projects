<section class="relative min-h-screen flex items-center overflow-x-clip bg-secondary" id="home">
    <!-- Background image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero-image.webp') }}" alt="" class="w-full h-full object-cover">
    </div>
    <!-- Overlay biru -->
    <div class="absolute inset-0 z-1 bg-linear-to-br from-secondary/95 via-secondary/85 to-primary/75"></div>
    <!-- Grid background -->
    <div class="absolute inset-0 z-2 pointer-events-none bg-[linear-gradient(to_right,#ffffff0A_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0A_1px,transparent_1px)] bg-size-[24px_24px]"></div>
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[70%] h-[60%] rounded-full bg-primary/25 blur-3xl pointer-events-none z-2"></div>
    <div class="absolute bottom-0 right-0 w-[45%] h-[50%] rounded-full bg-accent/20 blur-3xl pointer-events-none z-2"></div>
    <div class="absolute top-16 right-10 w-72 h-72 rounded-full bg-accent/15 blur-3xl pointer-events-none z-2"></div>

    <!-- Flying icons -->
    <div class="hero-icons absolute inset-0 z-2 pointer-events-none will-change-transform">
        @php
            $chips = [
                ['icon' => 'flask-conical', 'label' => __('ui.hero.chips.0'), 'pos' => 'left-[6%] top-[24%]', 'dur' => 4.5, 'delay' => 0, 'dist' => 12],
                ['icon' => 'factory', 'label' => __('ui.hero.chips.1'), 'pos' => 'right-[5%] top-[20%]', 'dur' => 5.2, 'delay' => 0.4, 'dist' => 10],
                ['icon' => 'scroll-text', 'label' => __('ui.hero.chips.2'), 'pos' => 'left-[8%] top-[60%]', 'dur' => 4.8, 'delay' => 0.8, 'dist' => 13],
                ['icon' => 'leaf', 'label' => __('ui.hero.chips.3'), 'pos' => 'right-[7%] top-[56%]', 'dur' => 5.6, 'delay' => 0.2, 'dist' => 11],
                ['icon' => 'shield-check', 'label' => __('ui.hero.chips.4'), 'pos' => 'left-[15%] bottom-[22%]', 'dur' => 5.0, 'delay' => 0.6, 'dist' => 10],
                ['icon' => 'bar-chart-3', 'label' => __('ui.hero.chips.5'), 'pos' => 'right-[14%] bottom-[24%]', 'dur' => 4.4, 'delay' => 1.0, 'dist' => 14],
            ];
        @endphp

        <!-- Flying chips: 2 baris rapi di tablet (md-lg), sembunyi di mobile -->
        <div class="hidden md:flex xl:hidden absolute inset-x-0 top-28 flex-wrap justify-center gap-2 px-4">
            @foreach(array_slice($chips, 0, 3) as $chip)
                <div class="fly-chip flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md text-white text-xs font-medium shadow-lg shadow-black/10"
                     data-float-dur="{{ $chip['dur'] }}" data-float-delay="{{ $chip['delay'] }}" data-float-dist="6">
                    <i data-lucide="{{ $chip['icon'] }}" class="w-4 h-4 text-accent"></i>
                    <span>{{ $chip['label'] }}</span>
                </div>
            @endforeach
        </div>
        <div class="hidden md:flex xl:hidden absolute inset-x-0 bottom-8 flex-wrap justify-center gap-2 px-4">
            @foreach(array_slice($chips, 3) as $chip)
                <div class="fly-chip flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md text-white text-xs font-medium shadow-lg shadow-black/10"
                     data-float-dur="{{ $chip['dur'] }}" data-float-delay="{{ $chip['delay'] }}" data-float-dist="6">
                    <i data-lucide="{{ $chip['icon'] }}" class="w-4 h-4 text-accent"></i>
                    <span>{{ $chip['label'] }}</span>
                </div>
            @endforeach
        </div>

        <!-- Flying chips: posisi floating di xl+ -->
        @foreach($chips as $chip)
            <div class="fly-chip hidden xl:flex items-center gap-2.5 px-4 py-2.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md text-white text-sm font-medium shadow-lg shadow-black/10 absolute {{ $chip['pos'] }}"
                 data-float-dur="{{ $chip['dur'] }}" data-float-delay="{{ $chip['delay'] }}" data-float-dist="{{ $chip['dist'] }}">
                <i data-lucide="{{ $chip['icon'] }}" class="w-5 h-5 text-accent"></i>
                <span>{{ $chip['label'] }}</span>
            </div>
        @endforeach
    </div>

    <!-- Teks -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 py-32 lg:py-40">
        <div class="hero-content text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-white text-[10px] font-semibold backdrop-blur-sm border border-white/20 mb-6">
                <span class="relative h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                </span>
                Applied Research &amp; Policy Advisory | Engineering | TIC
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight tracking-tight mb-6">
                {{ __('ui.hero.h1_part1') }} <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-300 via-white to-green-300">{{ __('ui.hero.h1_highlight') }}</span> {{ __('ui.hero.h1_part2') }} <span class="relative inline-block whitespace-nowrap">{{ __('ui.hero.h1_underline') }}
                    <svg class="absolute -bottom-2 left-0 w-full h-3" viewBox="0 0 220 16" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M2,11 C30,2 60,14 90,8 C120,3 150,12 180,7 C196,4 210,8 218,6" fill="none" stroke="#22C55E" stroke-width="5" stroke-linecap="round"></path>
                    </svg>
                </span>
            </h1>

            <p class="text-lg md:text-xl text-white mb-8 max-w-2xl mx-auto leading-relaxed">
                {{ __('ui.hero.subtitle') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-primary bg-white rounded-xl hover:bg-white/90 transition-all duration-300 shadow-xl shadow-black/20 group">
                    {{ __('ui.hero.cta_primary') }}
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ lroute('about') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-white/10 border border-white/30 rounded-xl backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                    {{ __('ui.hero.cta_secondary') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Wave putih -->
    <x-landing.wave fill="#FFFFFF" />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const heroEl = document.querySelector('#home');
            if (!heroEl) return;

            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // Entrance animasi teks hero
            if (!prefersReduced) {
                gsap.fromTo('.hero-content > *',
                    { y: 30, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.9, stagger: 0.12, ease: 'power3.out', delay: 0.2 }
                );
            }

            const chips = gsap.utils.toArray('.fly-chip');

            if (prefersReduced || !chips.length) return;

            // Floating: naik-turun + rotasi tipis
            chips.forEach((el) => {
                const dur = parseFloat(el.dataset.floatDur || 5);
                const delay = parseFloat(el.dataset.floatDelay || 0);
                const dist = parseFloat(el.dataset.floatDist || 10);
                gsap.to(el, {
                    y: dist,
                    rotation: 4,
                    duration: dur,
                    delay,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });
            });

            // Parallax mengikuti kursor (sumbu x)
            const xTos = chips.map((el, i) => {
                const depth = 18 + (i % 4) * 10;
                return { to: gsap.quickTo(el, 'x', { duration: 0.9, ease: 'power3.out' }), depth };
            });

            heroEl.addEventListener('mousemove', (e) => {
                const relX = e.clientX / window.innerWidth - 0.5;
                xTos.forEach(({ to, depth }) => to(relX * depth));
            });
            heroEl.addEventListener('mouseleave', () => {
                xTos.forEach(({ to }) => to(0));
            });

            // Parallax saat scroll (kelompok ikon)
            const iconsWrap = document.querySelector('.hero-icons');
            if (iconsWrap && gsap.ScrollTrigger) {
                gsap.fromTo(iconsWrap, { y: -30 }, {
                    y: 30,
                    ease: 'none',
                    scrollTrigger: { trigger: heroEl, start: 'top top', end: 'bottom top', scrub: 0.6 },
                });
            }
        });
    </script>
</section>
