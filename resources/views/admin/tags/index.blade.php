@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Tag" subtitle="Kelola tag untuk penandaan artikel.">
        @can('tags.create')
        <x-slot name="actions">
            <button type="button"
                    onclick="document.getElementById('create-tag').classList.toggle('hidden')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Tag
            </button>
        </x-slot>
        @endcan
    </x-admin.page-header>
@endsection

@section('content')
    @can('tags.create')
    <x-card class="mb-6 hidden" id="create-tag">
        <div class="p-6">
            <form method="POST" action="{{ panel_route('tags.store') }}" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <div class="flex-1">
                    <input type="text" name="name" required placeholder="Nama tag"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                </div>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Simpan</button>
            </form>
            @error('name') <p class="text-xs text-danger mt-2">{{ $message }}</p> @enderror
        </div>
    </x-card>
    @endcan

    <x-card>
        <div class="p-6">
            <form method="GET" action="{{ panel_route('tags.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tag..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Filter</button>
            </form>

            <div class="flex flex-wrap gap-3">
                @forelse ($tags as $tag)
                    <div class="inline-flex items-center gap-2 bg-gray-50 border border-gray-100 rounded-full px-4 py-2">
                        <i data-lucide="tag" class="w-3.5 h-3.5 text-primary"></i>
                        <span class="text-sm font-medium text-secondary">{{ $tag->name }}</span>
                        <span class="text-xs text-gray-400">{{ $tag->articles_count }}</span>
                        @can('tags.delete')
                        <form method="POST" action="{{ panel_route('tags.destroy', $tag) }}" onsubmit="return confirm('Hapus tag ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-danger transition-colors">
                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                @empty
                    <div class="w-full py-12 text-center">
                        <i data-lucide="tag" class="w-10 h-10 text-gray-300 mx-auto mb-4"></i>
                        <p class="text-sm text-gray-400">Belum ada tag.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $tags->links() }}
            </div>
        </div>
    </x-card>
@endsection
