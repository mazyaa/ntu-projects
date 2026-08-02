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

    <!-- SEO Meta Tags -->
    <meta name="description" content="PT Nusantara Techno Utama (NTU) - Perusahaan riset terapan dan kebijakan, rekayasa teknologi, pengelolaan lingkungan, serta layanan Testing, Inspection & Certification (TIC) untuk Indonesia yang berkelanjutan.">
    <meta name="keywords" content="NTU, Riset Terapan, Kajian Kebijakan, Engineering, Teknologi Lingkungan, TIC, Inspeksi Teknik, PT Nusantara Techno Utama">
    <meta property="og:title" content="NTU - @yield('title', 'Beranda')">
    <meta property="og:description" content="Mitra riset dan teknologi terpercaya untuk Indonesia yang berkelanjutan.">
    <meta property="og:image" content="{{ asset('images/logo/hero-logo.png') }}">

    <title>NTU - @yield('title', 'Beranda')</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-secondary bg-background selection:bg-primary selection:text-white">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-100 bg-white flex items-center justify-center transition-opacity duration-500">
        <div class="animate-pulse flex flex-col items-center">
            <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="w-28 h-28 object-contain">
            <div class="text-secondary font-bold tracking-widest text-sm uppercase mt-4">Memuat...</div>
        </div>
    </div>

    <!-- Navigation -->
    <x-landing.navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-landing.footer />

    <!-- Floating Chatbot -->
    <x-landing.chatbot />

    <!-- Initialization Scripts -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            if(preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (!window.Notyf) return;

            const success = @json(session('success'));
            const error = @json(session('error'));

            if (success) window.Notyf.success(success);
            if (error) window.Notyf.error(error);
        });
    </script>
</body>
</html>
