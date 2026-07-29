<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-secondary bg-slate-50 antialiased selection:bg-primary selection:text-white relative min-h-screen flex items-center justify-center">
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[30%] -right-[10%] w-[70%] h-[70%] rounded-full bg-primary/5 blur-3xl"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-accent/5 blur-3xl"></div>
        </div>

        <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white/70 backdrop-blur-xl shadow-2xl shadow-gray-200/50 sm:rounded-2xl border border-white/50">
            <div class="flex justify-center mb-8">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-primary drop-shadow-md" />
                </a>
            </div>
            
            {{ $slot }}
        </div>
    </body>
</html>
