@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Detail Media" subtitle="{{ $media->name }}" back="{{ panel_route('media.index') }}" />
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card>
                <div class="p-6">
                    @if($media->is_image)
                        <div class="bg-gray-50 rounded-lg overflow-hidden">
                            <img src="{{ $media->url }}" alt="{{ $media->alt_text }}" class="w-full">
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-12 text-center">
                            <i data-lucide="file" class="w-16 h-16 mx-auto mb-4 text-gray-400"></i>
                            <p class="text-gray-500">{{ $media->file_type }}</p>
                        </div>
                    @endif
                </div>
            </x-card>
        </div>

        <div class="space-y-6">
            <x-card>
                <div class="p-6 space-y-4">
                    <h3 class="text-base font-bold text-secondary">Detail</h3>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Nama File</label>
                        <p class="text-sm text-secondary font-medium">{{ $media->name }}</p>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Ukuran</label>
                        <p class="text-sm text-secondary">{{ $media->size_for_humans }}</p>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Tipe</label>
                        <p class="text-sm text-secondary">{{ $media->file_type }}</p>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">URL</label>
                        <div class="flex items-center gap-2">
                            <input type="text" value="{{ $media->url }}" readonly
                                   class="flex-1 py-1.5 px-3 text-xs bg-gray-50 border border-gray-200 rounded-lg">
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $media->url }}')"
                                    class="px-3 py-1.5 text-xs font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Copy</button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Caption</label>
                        <form method="POST" action="{{ panel_route('media.update', $media) }}">
                            @csrf @method('PUT')
                            <textarea name="caption" rows="2"
                                      class="w-full py-1.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ $media->caption }}</textarea>
                            <button type="submit" class="mt-2 px-4 py-1.5 text-xs font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Simpan Caption</button>
                        </form>
                    </div>
                </div>
            </x-card>

            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4">Aksi</h3>
                    <div class="space-y-2">
                        <a href="{{ $media->url }}" target="_blank" class="block w-full text-center px-4 py-2 text-sm font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20">
                            Buka di Tab Baru
                        </a>
                        <form method="POST" action="{{ panel_route('media.destroy', $media) }}" onsubmit="return confirm('Yakin ingin menghapus media ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-danger bg-red-50 rounded-lg hover:bg-red-100">
                                Hapus Media
                            </button>
                        </form>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
