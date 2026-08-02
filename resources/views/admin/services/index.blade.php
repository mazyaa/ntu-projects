@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Layanan" subtitle="Kelola pilar layanan perusahaan.">
        @can('services.create')
        <x-slot name="actions">
            <a href="{{ panel_route('services.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Layanan
            </a>
        </x-slot>
        @endcan
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <form method="GET" action="{{ panel_route('services.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari layanan..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Filter</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="py-3 px-4">Urutan</th>
                            <th class="py-3 px-4">Judul</th>
                            <th class="py-3 px-4">Slug</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Item</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($services as $service)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $service->sort_order }}</td>
                                <td class="py-3 px-4 text-sm font-semibold text-secondary">{{ $service->title }}</td>
                                <td class="py-3 px-4 text-xs text-gray-400 font-mono">{{ $service->slug }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->status->color() }}">
                                        {{ $service->status->label() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ count($service->service_items ?? []) }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end gap-1">
                                        @can('services.edit')
                                        <a href="{{ panel_route('services.edit', $service) }}" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        @endcan
                                        @can('services.delete')
                                        <form method="POST" action="{{ panel_route('services.destroy', $service) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-danger hover:bg-red-50 transition-colors" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sm text-gray-400">Belum ada layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </x-card>
@endsection
