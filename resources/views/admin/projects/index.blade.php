@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Proyek" subtitle="Kelola data proyek pengalaman." />
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <form method="GET" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari proyek..."
                           class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Filter</button>
                </form>
                <a href="{{ panel_route('projects.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">
                    + Tambah Proyek
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Judul</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Klien</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Tahun</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Status</th>
                            <th class="text-right py-3 px-4 font-semibold text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-secondary">{{ $project->title }}</div>
                                    @if($project->title_en)
                                        <div class="text-xs text-gray-400">{{ $project->title_en }}</div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-500">{{ $project->client ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-500">{{ $project->year ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    @if($project->is_featured)
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Unggulan</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ panel_route('projects.edit', $project) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-primary/10">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        <form method="POST" action="{{ panel_route('projects.destroy', $project) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-danger rounded-lg hover:bg-red-50">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400">
                                    <i data-lucide="folder-open" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                                    Belum ada data proyek.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $projects->links() }}
            </div>
        </div>
    </x-card>
@endsection
