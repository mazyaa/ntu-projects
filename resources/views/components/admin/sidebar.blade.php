<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-100 shadow-sm lg:static lg:inset-0 transition-transform duration-300 ease-in-out transform"
       :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'lg:translate-x-0': true}">
    
    <!-- Logo Area -->
    <div class="flex items-center justify-center h-16 border-b border-gray-100 px-6">
        <a href="#" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-primary text-white flex items-center justify-center">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <span class="text-lg font-bold text-secondary tracking-tight">NTU Admin</span>
        </a>
    </div>

    <!-- Navigation -->
    <div class="overflow-y-auto overflow-x-hidden flex-grow p-4">
        <ul class="flex flex-col py-2 space-y-1">
            <li class="px-3">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Main</div>
            </li>
            <li>
                <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-primary border-l-4 border-transparent hover:border-primary rounded-r-lg pr-6 transition-colors duration-200">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Dashboard</span>
                </a>
            </li>
            
            <li class="px-3 mt-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Management</div>
            </li>
            <li>
                <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-primary border-l-4 border-transparent hover:border-primary rounded-r-lg pr-6 transition-colors duration-200">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Users</span>
                </a>
            </li>
            <li>
                <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-primary border-l-4 border-transparent hover:border-primary rounded-r-lg pr-6 transition-colors duration-200">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i data-lucide="shield" class="w-5 h-5"></i>
                    </span>
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Roles & Permissions</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
