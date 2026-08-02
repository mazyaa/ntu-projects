<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/logo/navbar-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>{{ config('company.short_name', 'NTU') }} - {{ Auth::user()->getRoleNames()->first() ?? 'Panel' }}</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body data-admin="true" class="bg-slate-100/70 text-secondary font-sans overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen w-full bg-slate-50">
        
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            
            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-100/70 p-6 lg:p-8">
                @yield('breadcrumb')
                
                @yield('content')
            </main>
        </div>
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.300ms
             @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-secondary/60 backdrop-blur-sm lg:hidden" style="display: none;"></div>
    </div>

    @stack('scripts')

    <script>
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
