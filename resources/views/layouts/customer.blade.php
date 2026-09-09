<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] ?? config('company.short_name') }}</title>

    {{-- Preload fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Montserrat:300,400,500,600,700,800,900|100|200|800|900|Poppins:300,400,500,600,700,800,900|100|200|800|900" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-favicon.png') }}">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body data-dashboard="true" class="font-sans text-secondary bg-slate-100/70 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen w-full bg-slate-50">

        {{-- Sidebar --}}
        <x-customer.sidebar />

        {{-- Main Content --}}
        <div class="flex flex-col flex-1 w-full overflow-hidden lg:ml-64">

            {{-- Top Navbar --}}
            <header class="sticky top-0 z-20 flex items-center h-16 px-4 sm:px-6 bg-white border-b border-gray-200 shrink-0">
                {{-- Mobile hamburger --}}
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 -ml-2 text-gray-500 hover:text-primary lg:hidden" aria-label="Toggle sidebar">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                {{-- Page title --}}
                <div class="flex-1 ml-4 lg:ml-0">
                    <h1 class="text-lg font-semibold text-secondary">@yield('title', 'Dashboard')</h1>
                </div>

                {{-- User dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                        @if(Auth::user()->avatar)
                            <img src="{{ storage_file_url(Auth::user()->avatar) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border-2 border-primary/20">
                        @else
                            <span class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-sm font-bold text-primary">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                        <span class="hidden sm:block text-sm font-medium text-secondary">{{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50"
                         style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-semibold text-secondary">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('customer.profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i> Profil Saya
                        </a>
                        <a href="{{ route('customer.company') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">
                            <i data-lucide="building-2" class="w-4 h-4"></i> Profil Perusahaan
                        </a>
                        <hr class="my-1 border-gray-100">
                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm transition-opacity lg:hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;">
        </div>
    </div>

    {{-- Flash Messages (Notyf) --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Notyf.success({ message: '{!! session('success') !!}', duration: 5000, position: { x: 'right', y: 'top' } });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Notyf.error({ message: '{!! session('error') !!}', duration: 5000, position: { x: 'right', y: 'top' } });
            });
        </script>
    @endif

    @if(session('toast'))
        @php $toast = session('toast'); @endphp
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const type = '{{ $toast["type"] ?? "info" }}';
                const message = '{!! $toast["message"] !!}';
                if (type === 'error') {
                    Notyf.error({ message, duration: 5000, position: { x: 'right', y: 'top' } });
                } else {
                    Notyf.success({ message, duration: 5000, position: { x: 'right', y: 'top' } });
                }
            });
        </script>
    @endif

    <script>
        document.addEventListener('livewire:navigate', () => {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>
</html>
