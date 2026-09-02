@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Halaman Statis" subtitle="Kelola konten halaman statis (tentang, kontak, dll)." />
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <form method="GET" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari halaman..."
                           class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <select name="status" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Semua Status</option>
                        <option value="active" @selected(request('status') === 'active')">Aktif</option>
                        <option value="inactive" @selected(request('status') === 'inactive')">Nonaktif</option>
                    </select>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Filter</button>
                </form>
                <a href="{{ panel_route('pages.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">
                    + Tambah Halaman
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Judul</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Slug</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Status</th>
                            <th class="text-left py-3 px-4 font-semibold text-secondary">Terakhir Diupdate</th>
                            <th class="text-right py-3 px-4 font-semibold text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $page)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-secondary">{{ $page->title }}</div>
                                    @if($page->title_en)
                                        <div class="text-xs text-gray-400">{{ $page->title_en }}</div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-500 font-mono text-xs">{{ $page->slug }}</td>
                                <td class="py-3 px-4">
                                    @if($page->is_active)
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-500 rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-500">{{ $page->updated_at?->diffForHumans() ?? '-' }}</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ panel_route('pages.edit', $page) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-primary/10">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        <form method="POST" action="{{ panel_route('pages.destroy', $page) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                    <i data-lucide="file-text" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                                    Belum ada halaman statis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pages->links() }}
            </div>
        </div>
    </x-card>
@endsection
