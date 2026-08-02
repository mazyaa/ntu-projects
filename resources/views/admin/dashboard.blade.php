@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Dashboard" subtitle="Welcome back, {{ Auth::user()->name ?? 'Admin' }}.">
    </x-admin.page-header>
@endsection

@section('content')
    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @can('analytics.view')
        <x-card class="flex items-center p-6">
            <div class="p-3 rounded-xl bg-primary/10 text-primary mr-4">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Views</p>
                <p class="text-2xl font-bold text-secondary mt-1">{{ number_format($stats['total_views'], 0, ',', '.') }}</p>
            </div>
        </x-card>

        <x-card class="flex items-center p-6">
            <div class="p-3 rounded-xl bg-accent/10 text-accent mr-4">
                <i data-lucide="user-check" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Pengunjung Unik</p>
                <p class="text-2xl font-bold text-secondary mt-1">{{ number_format($stats['unique_visitors'], 0, ',', '.') }}</p>
            </div>
        </x-card>
        @endcan

        <x-card class="flex items-center p-6">
            <div class="p-3 rounded-xl bg-success/10 text-success mr-4">
                <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Artikel</p>
                <p class="text-2xl font-bold text-secondary mt-1">{{ $stats['articles'] }}</p>
            </div>
        </x-card>

        <x-card class="flex items-center p-6">
            <div class="p-3 rounded-xl bg-warning/10 text-warning mr-4">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Artikel Terbit</p>
                <p class="text-2xl font-bold text-secondary mt-1">{{ $stats['published_articles'] }}</p>
            </div>
        </x-card>
    </div>

    @can('analytics.view')
    <!-- Views Harian + Artikel Terpopuler -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2">
            <x-card class="flex flex-col h-full">
                <div class="p-6 pb-0">
                    <h3 class="text-lg font-bold text-secondary">Views Harian (30 Hari)</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Jumlah kunjungan artikel per hari selama 30 hari terakhir</p>
                </div>
                <div class="p-6 flex-1">
                    <div id="dashboard-views-chart" class="w-full h-72"></div>
                </div>
            </x-card>
        </div>

        <div>
            <x-card class="flex flex-col h-full">
                <div class="p-6 pb-0">
                    <h3 class="text-lg font-bold text-secondary">Artikel Terpopuler</h3>
                    <p class="text-sm text-gray-500 mt-0.5">10 artikel dengan kunjungan terbanyak</p>
                </div>
                <div class="p-6 flex-1">
                    <ol class="space-y-4">
                        @forelse ($topArticles as $index => $article)
                            <li class="flex items-center justify-between gap-3">
                                <span class="flex items-center gap-3 text-sm font-medium text-secondary truncate">
                                    <span class="w-5 h-5 flex items-center justify-center rounded-full bg-primary/10 text-primary text-xs font-bold shrink-0">{{ $index + 1 }}</span>
                                    <span class="truncate">{{ $article->title }}</span>
                                </span>
                                <span class="flex items-center gap-1 text-xs font-semibold text-primary shrink-0">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    {{ number_format($article->views_count, 0, ',', '.') }}
                                </span>
                            </li>
                        @empty
                            <p class="text-sm text-gray-400">Belum ada kunjungan.</p>
                        @endforelse
                    </ol>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Distribusi Views per Kategori -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-3">
            <x-card class="flex flex-col h-full">
                <div class="p-6 pb-0">
                    <h3 class="text-lg font-bold text-secondary">Distribusi Views per Kategori</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Total kunjungan artikel berdasarkan kategori</p>
                </div>
                <div class="p-6 flex-1">
                    <div id="dashboard-category-chart" class="w-full h-72"></div>
                </div>
            </x-card>
        </div>
    </div>
    @endcan

    @push('scripts')
    <script>
        const dashboardCategories = @json($viewsByCategory ?? []);
        const dashboardViewsLabels = @json($labels ?? []);
        const dashboardViewsSeries = @json($series ?? []);

        document.addEventListener('DOMContentLoaded', () => {
            const viewsEl = document.getElementById('dashboard-views-chart');
            if (viewsEl && window.ApexCharts) {
                const total = dashboardViewsSeries.reduce((a, b) => a + b, 0);

                if (total === 0) {
                    viewsEl.innerHTML = '<div class="flex items-center justify-center h-full"><span class="text-gray-400 font-medium text-sm">Belum ada data kunjungan.</span></div>';
                } else {
                    new ApexCharts(viewsEl, {
                        chart: {
                            type: 'area',
                            height: '100%',
                            fontFamily: 'Poppins, sans-serif',
                            toolbar: { show: false },
                            zoom: { enabled: false },
                        },
                        series: [{ name: 'Views', data: dashboardViewsSeries }],
                        colors: ['#0736AA'],
                        stroke: { curve: 'smooth', width: 3 },
                        fill: {
                            type: 'gradient',
                            gradient: { shadeIntensity: 1, opacityFrom: 0.35, opacityTo: 0.05, stops: [0, 90, 100] },
                        },
                        xaxis: {
                            categories: dashboardViewsLabels,
                            labels: { style: { colors: '#94a3b8', fontSize: '11px' } },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                        },
                        yaxis: {
                            labels: { style: { colors: '#94a3b8', fontSize: '11px' } },
                        },
                        grid: { borderColor: '#e2e8f0', strokeDashArray: 4 },
                        dataLabels: { enabled: false },
                        tooltip: {
                            theme: 'light',
                            y: { formatter: (val) => val.toLocaleString('id-ID') + ' views' },
                        },
                    }).render();
                }
            }

            const el = document.getElementById('dashboard-category-chart');
            if (!el || !window.ApexCharts) return;

            const names = dashboardCategories.map((c) => c.name);
            const values = dashboardCategories.map((c) => c.total);

            if (dashboardCategories.length === 0 || values.reduce((a, b) => a + b, 0) === 0) {
                el.innerHTML = '<div class="flex items-center justify-center h-full"><span class="text-gray-400 font-medium text-sm">Belum ada data kunjungan.</span></div>';
                return;
            }

            const colors = ['#0736AA', '#0B9918', '#F59E0B', '#22C55E', '#EF4444', '#6366F1', '#0EA5E9', '#8B5CF6', '#F97316', '#14B8A6'];

            new ApexCharts(el, {
                chart: {
                    type: 'donut',
                    height: '100%',
                    fontFamily: 'Poppins, sans-serif',
                },
                series: values,
                labels: names,
                colors: colors,
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    labels: { colors: '#475569' },
                    fontSize: '12px',
                    itemMargin: { horizontal: 8, vertical: 4 },
                },
                dataLabels: {
                    enabled: true,
                    formatter: (val) => val.toFixed(0) + '%',
                    style: { fontSize: '11px', fontWeight: '600' },
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '68%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Views',
                                    fontSize: '13px',
                                    color: '#94a3b8',
                                    formatter: () => values.reduce((a, b) => a + b, 0).toLocaleString('id-ID'),
                                },
                            },
                        },
                    },
                },
                stroke: { width: 2, colors: ['#ffffff'] },
                tooltip: {
                    theme: 'light',
                    y: { formatter: (val) => val.toLocaleString('id-ID') + ' views' },
                },
            }).render();
        });
    </script>
    @endpush
@endsection
