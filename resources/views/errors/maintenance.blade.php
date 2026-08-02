<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" href="{{ asset('images/logo/navbar-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>{{ config('company.short_name', 'NTU') }} - Sedang Dalam Pemeliharaan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-secondary bg-background selection:bg-primary selection:text-white">

    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-secondary">
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

        <!-- Konten -->
        <div class="relative z-10 w-full max-w-2xl mx-auto px-6 lg:px-8 py-32 text-center">
            <div class="flex flex-col items-center">

                <div class="w-24 h-24 rounded-2xl bg-white shadow-2xl shadow-black/20 flex items-center justify-center p-2.5 mb-8">
                    <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name', 'NTU') }} Logo" class="w-full h-full object-contain">
                </div>

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-white text-xs font-semibold backdrop-blur-sm border border-white/20 mb-6">
                    <span class="relative h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                    </span>
                    Mode Maintenance Aktif
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight tracking-tight mb-5">
                    Kami Sedang Dalam<br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-300 via-white to-green-300">Pemeliharaan Sistem</span>
                </h1>

                <p class="text-base md:text-lg text-white/85 mb-2 leading-relaxed">
                    Situs kami sedang menjalani perawatan terjadwal untuk meningkatkan
                    layanan dan pengalaman Anda.
                </p>
                <p class="text-sm text-white/60 mb-10 leading-relaxed">
                    Kami akan segera kembali. Mohon maaf atas ketidaknyamanannya, dan
                    terima kasih atas kesabaran Anda.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 mb-6">
                    <a href="mailto:info@techno-inovation.com" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-primary bg-white rounded-xl hover:bg-white/90 transition-all duration-300 shadow-xl shadow-black/20">
                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>

                <div class="inline-flex items-center gap-2 text-xs text-white/50">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5 animate-spin"></i>
                    Silakan kembali beberapa saat lagi.
                </div>
            </div>
        </div>
    </section>

</body>
</html>
