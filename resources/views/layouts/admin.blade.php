<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- JS Libraries -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50/50 text-secondary font-sans overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen w-full bg-slate-50">
        
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            
            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50/50 p-6">
                @yield('breadcrumb')
                
                @yield('content')
            </main>
        </div>
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.300ms
             @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm lg:hidden" style="display: none;"></div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
