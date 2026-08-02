<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-secondary via-secondary to-primary text-white shadow-xl lg:static lg:inset-0 transition-transform duration-300 ease-in-out transform"
       :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'lg:translate-x-0': true}">

    <!-- Logo Area -->
    <div class="flex items-center justify-center h-16 border-b border-white/10 px-6">
        <a href="{{ panel_route('dashboard') }}" class="flex items-center gap-2.5 group">
            <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="NTU Logo"
                 class="w-9 h-9 object-contain rounded-lg bg-white p-0.5 shadow-md group-hover:scale-105 transition-transform"
                 onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true&size=128'">
            <div class="flex flex-col leading-tight">
                <span class="text-base font-bold text-white tracking-tight">NTU {{ Auth::user()->getRoleNames()->first() ?? 'Admin' }}</span>
                <span class="text-[10px] text-white/50 font-medium uppercase tracking-widest">{{ Auth::user()->hasRole('Editor') ? 'Panel Editor' : 'Panel Manajemen' }}</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <div class="overflow-y-auto overflow-x-hidden flex-grow p-4">
        <ul class="flex flex-col py-2 space-y-1">
            <li class="px-3">
                <div class="text-xs font-semibold text-white/40 uppercase tracking-wider mb-2">Menu Utama</div>
            </li>
            <li>
                <a href="{{ panel_route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.dashboard', 'editor.dashboard') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Dashboard</span>
                </a>
            </li>

            @can('contacts.view')
            <li>
                <a href="{{ panel_route('contacts.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.contacts*', 'editor.contacts*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="inbox" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Inbox Pesan</span>
                </a>
            </li>
            @endcan

            @can('articles.view')
            <li class="px-3 mt-6">
                <div class="text-xs font-semibold text-white/40 uppercase tracking-wider mb-2">Konten</div>
            </li>
            <li>
                <a href="{{ panel_route('articles.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.articles*', 'editor.articles*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Artikel</span>
                </a>
            </li>
            @endcan

            @can('services.view')
            <li>
                <a href="{{ panel_route('services.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.services*', 'editor.services*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Layanan</span>
                </a>
            </li>
            @endcan

            @can('categories.view')
            <li>
                <a href="{{ panel_route('categories.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.categories*', 'editor.categories*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="folder" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Kategori</span>
                </a>
            </li>
            @endcan

            @can('tags.view')
            <li>
                <a href="{{ panel_route('tags.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.tags*', 'editor.tags*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="tag" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Tag</span>
                </a>
            </li>
            @endcan

            @can('users.view')
            <li class="px-3 mt-6">
                <div class="text-xs font-semibold text-white/40 uppercase tracking-wider mb-2">Sistem</div>
            </li>
            <li>
                <a href="{{ panel_route('users.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.users*', 'editor.users*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Pengguna</span>
                </a>
            </li>
            @endcan

            @can('activity_logs.view')
            <li>
                <a href="{{ panel_route('activity-logs.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.activity-logs*', 'editor.activity-logs*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="scroll-text" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Activity Logs</span>
                </a>
            </li>
            @endcan

            @can('settings.edit')
            <li>
                <a href="{{ panel_route('settings.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white/10 text-white/70 hover:text-white border-l-4 border-transparent hover:border-white rounded-r-lg pr-6 transition-colors duration-200 {{ request()->routeIs('admin.settings*', 'editor.settings*') ? 'bg-white/10 text-white border-white' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="settings-2" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Settings</span>
                </a>
            </li>
            @endcan
        </ul>

        <div class="mt-8 px-4">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-white/10 hover:bg-white/20 border border-white/15 rounded-lg transition-colors duration-200">
                <i data-lucide="globe" class="w-4 h-4"></i>
                Lihat Situs Publik
            </a>
        </div>
    </div>
</aside>
