<x-admin-layout>
    <x-slot name="breadcrumb">
        <h2 class="font-semibold text-2xl text-secondary leading-tight tracking-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">Welcome back, {{ Auth::user()->name ?? 'Admin' }}. Here's what's happening.</p>
    </x-slot>

    <!-- Statistics Placeholder -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @for ($i = 0; $i < 4; $i++)
            <x-card class="flex items-center p-6">
                <div class="p-3 rounded-xl bg-primary/10 text-primary mr-4">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Metric {{ $i+1 }}</p>
                    <p class="text-2xl font-bold text-secondary mt-1">0</p>
                </div>
            </x-card>
        @endfor
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Chart Placeholder -->
        <div class="lg:col-span-2">
            <x-card class="h-96 flex flex-col">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-secondary">Analytics Overview</h3>
                    <p class="text-sm text-gray-500">Monthly performance metrics</p>
                </div>
                <div class="flex-1 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center bg-gray-50">
                    <span class="text-gray-400 font-medium">Chart Placeholder (ApexCharts)</span>
                </div>
            </x-card>
        </div>

        <!-- Recent Activity Placeholder -->
        <div class="lg:col-span-1">
            <x-card class="h-96">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-secondary">Recent Activity</h3>
                    <button class="text-sm text-primary font-medium hover:underline">View all</button>
                </div>
                <div class="space-y-4">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-accent/10 flex-shrink-0 flex items-center justify-center text-accent mt-0.5">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-secondary">System Update</p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </x-card>
        </div>
    </div>
</x-admin-layout>
