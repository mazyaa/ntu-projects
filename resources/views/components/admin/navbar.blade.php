<header class="flex items-center justify-between px-6 lg:px-8 py-4 bg-white/90 backdrop-blur-md border-b border-gray-200/70 sticky top-0 z-10">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden mr-4 hover:text-primary transition-colors">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <!-- Breadcrumb -->
        <div class="hidden lg:flex items-center gap-2 text-sm text-gray-400">
            <a href="{{ panel_route('dashboard') }}" class="hover:text-primary transition-colors flex items-center gap-1.5">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>{{ Auth::user()->getRoleNames()->first() ?? 'Admin' }}</span>
            </a>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-9 h-9 rounded-full bg-linear-to-br from-primary to-secondary flex items-center justify-center text-white font-bold border-2 border-white shadow-md shadow-primary/20 group-hover:shadow-primary/40 transition-shadow overflow-hidden">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    @endif
                </div>
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-sm font-semibold text-secondary leading-tight">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="text-xs text-gray-400">{{ Auth::user()->getRoleNames()->first() ?? 'Super Admin' }}</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden md:block transition-transform" :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition.opacity
                 class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl py-2 border border-gray-100 z-50" style="display: none;">
                <div class="px-4 py-3 border-b border-gray-100 mb-1">
                    <p class="text-sm font-semibold text-secondary">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                </div>
                @can('settings.view')
                <a href="{{ panel_route('settings.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                    <i data-lucide="settings-2" class="w-4 h-4"></i> Settings
                </a>
                @endcan
                <a href="{{ panel_route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                    <i data-lucide="user" class="w-4 h-4"></i> Profil
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Situs
                </a>
                <hr class="my-2 border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-danger hover:bg-red-50 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
