<header class="flex items-center justify-between px-6 py-4 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-10">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden mr-4 hover:text-primary transition-colors">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        
        <!-- Search -->
        <div class="relative hidden sm:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
            </span>
            <input type="text" class="w-full sm:w-64 py-2 pl-10 pr-4 text-sm bg-gray-50 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400 transition-all duration-300 focus:bg-white" placeholder="Search...">
        </div>
    </div>

    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="relative p-2 text-gray-400 hover:text-primary transition-colors rounded-full hover:bg-gray-50">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-danger rounded-full border-2 border-white"></span>
        </button>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold border border-primary/20">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-sm font-semibold text-secondary leading-tight">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="text-xs text-gray-500">{{ Auth::user()->getRoleNames()->first() ?? 'Super Admin' }}</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden md:block"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition.opacity
                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-100 z-50" style="display: none;">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">Settings</a>
                <hr class="my-2 border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-danger hover:bg-red-50 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
