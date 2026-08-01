<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/logo/navbar-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>NTU - Masuk</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-secondary bg-white selection:bg-primary selection:text-white antialiased">
    <div class="min-h-screen flex">

        <!-- Panel Kiri -->
        <div id="auth-panel" class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-secondary items-center justify-center p-14">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff14_1px,transparent_1px),linear-gradient(to_bottom,#ffffff14_1px,transparent_1px)] bg-size-[28px_28px] pointer-events-none"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/30 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-16 w-96 h-96 rounded-full bg-accent/20 blur-3xl pointer-events-none"></div>


            <div class="relative z-10 text-center max-w-sm">
                <img src="{{ asset('images/logo/footer-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-16 w-auto mx-auto mb-8 drop-shadow-lg" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
                <h2 class="text-3xl font-bold text-white leading-tight mb-4">
                    Mitra Riset &amp; Teknologi untuk Indonesia yang Berkelanjutan
                </h2>
                <p class="text-white/70 leading-relaxed text-sm">
                    Riset terapan, kajian kebijakan berbasis bukti, rekayasa teknologi, dan layanan TIC yang terintegrasi untuk pemerintah, industri, dan masyarakat.
                </p>
            </div>
        </div>

        <!-- Panel Kanan -->
        <div class="w-full lg:w-1/2 relative flex items-center justify-center px-6 py-12 lg:px-16">
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/15 blur-3xl"></div>
            </div>
            <div class="relative z-10 w-full max-w-md glass-card rounded-3xl p-8 sm:p-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const panel = document.querySelector('#auth-panel');
            if (!panel) return;

            const chips = gsap.utils.toArray('.fly-chip');
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !chips.length) return;

            chips.forEach((el) => {
                gsap.to(el, {
                    y: 10,
                    rotation: 4,
                    duration: parseFloat(el.dataset.floatDur || 5),
                    delay: parseFloat(el.dataset.floatDelay || 0),
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });
            });

            panel.addEventListener('mousemove', (e) => {
                const relX = e.clientX / window.innerWidth - 0.5;
                chips.forEach((el, i) => {
                    gsap.to(el, { x: relX * (15 + (i % 4) * 8), duration: 0.9, ease: 'power3.out', overwrite: 'auto' });
                });
            });
        });
    </script>
</body>
</html>
