@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Media Library" subtitle="Kelola file media yang diupload." />
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <form method="GET" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari media..."
                           class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <select name="type" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Semua Tipe</option>
                        <option value="image" @selected(request('type') === 'image')">Gambar</option>
                        <option value="document" @selected(request('type') === 'document')">Dokumen</option>
                        <option value="video" @selected(request('type') === 'video')">Video</option>
                    </select>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Filter</button>
                </form>

                <div x-data="{ uploading: false }">
                    <form method="POST" action="{{ panel_route('media.store') }}" enctype="multipart/form-data"
                          x-on:submit="uploading = true">
                        @csrf
                        <label class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 cursor-pointer" :class="uploading ? 'opacity-50' : ''">
                            <span x-show="!uploading">+ Upload Media</span>
                            <span x-show="uploading" style="display: none;">Uploading...</span>
                            <input type="file" name="file" class="hidden" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.mp4"
                                   x-on:change="$el.closest('form').submit()">
                        </label>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse ($media as $item)
                    <div class="group relative bg-gray-50 rounded-lg border border-gray-100 overflow-hidden hover:border-primary/30 transition-colors">
                        <a href="{{ panel_route('media.show', $item) }}">
                            @if($item->is_image)
                                <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div class="aspect-square bg-gray-100 flex items-center justify-center">
                                    <i data-lucide="file" class="w-8 h-8 text-gray-400"></i>
                                </div>
                            @endif
                        </a>

                        <div class="p-2">
                            <div class="text-xs font-medium text-secondary truncate" title="{{ $item->name }}">{{ $item->name }}</div>
                            <div class="text-xs text-gray-400">{{ $item->size_for_humans }}</div>
                        </div>

                        <div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="flex items-center gap-1">
                                <button type="button" onclick="navigator.clipboard.writeText('{{ $item->url }}')" title="Copy URL"
                                        class="p-1 bg-white rounded shadow hover:bg-gray-50">
                                    <i data-lucide="link" class="w-3 h-3 text-gray-600"></i>
                                </button>
                                <form method="POST" action="{{ panel_route('media.destroy', $item) }}" onsubmit="return confirm('Yakin ingin menghapus media ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1 bg-white rounded shadow hover:bg-red-50">
                                        <i data-lucide="trash-2" class="w-3 h-3 text-red-500"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-400">
                        <i data-lucide="image" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                        Belum ada media yang diupload.
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $media->links() }}
            </div>
        </div>
    </x-card>
@endsection
