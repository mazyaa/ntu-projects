@php
    $menuItems = [
        'Menu Utama' => [
            ['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'customer.dashboard', 'active' => request()->routeIs('customer.dashboard')],
            ['label' => 'Ajukan Riksa Uji', 'icon' => 'file-plus', 'route' => 'customer.requests.create', 'active' => request()->routeIs('customer.requests.create')],
        ],
        'Riwayat' => [
            ['label' => 'Permohonan Saya', 'icon' => 'clipboard-list', 'route' => 'customer.requests', 'active' => request()->routeIs('customer.requests', 'customer.requests.show')],
        ],
        'Pengaturan' => [
            ['label' => 'Profil Saya', 'icon' => 'user', 'route' => 'customer.profile', 'active' => request()->routeIs('customer.profile*')],
            ['label' => 'Profil Perusahaan', 'icon' => 'building-2', 'route' => 'customer.company', 'active' => request()->routeIs('customer.company*')],
        ],
    ];
@endphp

<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transition-transform duration-300 lg:translate-x-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 h-16 border-b border-gray-100">
        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo/navbar-logo.png') }}" alt="{{ config('company.short_name') }} Logo" class="h-8 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
            <div>
                <p class="text-sm font-bold text-secondary leading-tight">{{ config('company.short_name', 'NTU') }}</p>
                <p class="text-[10px] text-gray-400 leading-tight">Panel Pelanggan</p>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex flex-col h-[calc(100vh-4rem)] overflow-y-auto">
        <div class="flex-1 px-3 py-4 space-y-6">
            @foreach($menuItems as $group => $items)
                <div>
                    <p class="px-3 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-wider">{{ $group }}</p>
                    <ul class="space-y-1">
                        @foreach($items as $item)
                            <li>
                                <a href="{{ route($item['route']) }}"
                                   class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200
                                          {{ $item['active']
                                             ? 'bg-primary/10 text-primary border-l-4 border-primary'
                                             : 'text-gray-600 hover:bg-gray-50 hover:text-primary border-l-4 border-transparent' }}">
                                    <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 shrink-0"></i>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- Logout --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <form method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 text-sm font-medium text-gray-600 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                    <i data-lucide="log-out" class="w-5 h-5 shrink-0"></i>
                    Keluar
                </button>
            </form>
        </div>
    </nav>
</aside>
