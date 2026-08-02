@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Kategori" subtitle="Kelola kategori untuk mengelompokkan artikel.">
        @can('categories.create')
        <x-slot name="actions">
            <button type="button"
                    onclick="document.getElementById('create-category').classList.toggle('hidden')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori
            </button>
        </x-slot>
        @endcan
    </x-admin.page-header>
@endsection

@section('content')
    @can('categories.create')
    <x-card class="mb-6 hidden" id="create-category">
        <div class="p-6">
            <form method="POST" action="{{ panel_route('categories.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @csrf
                <div>
                    <input type="text" name="name" required placeholder="Nama kategori"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                </div>
                <div>
                    <input type="text" name="name_en" placeholder="English name"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                </div>
                <div>
                    <input type="text" name="description" placeholder="Deskripsi (opsional)"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                </div>
                <div>
                    <input type="text" name="description_en" placeholder="English description (opsional)"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Simpan</button>
                </div>
            </form>
            @error('name') <p class="text-xs text-danger mt-2">{{ $message }}</p> @enderror
        </div>
    </x-card>
    @endcan

    <x-card>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($categories as $category)
                    <div class="bg-gray-50/60 border border-gray-100 rounded-xl p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-sm font-bold text-secondary">{{ $category->name }}
                                    @if($category->name_en)
                                        <span class="ml-1 text-xs font-medium text-gray-400">· {{ $category->name_en }}</span>
                                    @endif
                                </h3>
                                <p class="text-xs text-gray-400 mt-1 font-mono">{{ $category->slug }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $category->articles_count }} artikel</p>
                                @if($category->description)
                                    <p class="text-xs text-gray-400 mt-2 line-clamp-2">{{ $category->description }}</p>
                                @endif
                                @if($category->description_en)
                                    <p class="text-xs text-gray-400 mt-1 line-clamp-2 italic">{{ $category->description_en }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1">
                                @can('categories.edit')
                                <button type="button" onclick="editCategory('{{ $category->id }}', '{{ addslashes($category->name) }}', '{{ addslashes($category->name_en ?? '') }}', '{{ addslashes($category->description ?? '') }}', '{{ addslashes($category->description_en ?? '') }}')"
                                        class="p-2 rounded-lg text-gray-400 hover:text-primary hover:bg-gray-100 transition-colors">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                @endcan
                                @can('categories.delete')
                                <form method="POST" action="{{ panel_route('categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <i data-lucide="folder" class="w-10 h-10 text-gray-300 mx-auto mb-4"></i>
                        <p class="text-sm text-gray-400">Belum ada kategori.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </x-card>

    <form method="POST" id="edit-category-form" class="hidden">
        @csrf
        @method('PUT')
        <input type="hidden" name="name" id="edit-category-name">
        <input type="hidden" name="name_en" id="edit-category-name-en">
        <input type="hidden" name="description" id="edit-category-description">
        <input type="hidden" name="description_en" id="edit-category-description-en">
    </form>
@endsection

@push('scripts')
<script>
    function editCategory(id, name, nameEn, description, descriptionEn) {
        if (!window.Swal) return;
        Swal.fire({
            title: 'Edit Kategori',
            html: `
                <input id="swal-name" class="swal2-input" value="${name}">
                <input id="swal-name-en" class="swal2-input" placeholder="English name" value="${nameEn}">
                <textarea id="swal-description" class="swal2-textarea" placeholder="Deskripsi (opsional)">${description}</textarea>
                <textarea id="swal-description-en" class="swal2-textarea" placeholder="English description (opsional)">${descriptionEn}</textarea>
            `,
            showCancelButton: true,
            confirmButtonColor: '#0736AA',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const name = document.getElementById('swal-name').value;
                if (!name) {
                    Swal.showValidationMessage('Nama wajib diisi');
                    return false;
                }
                const form = document.getElementById('edit-category-form');
                form.action = "{{ panel_route('categories.update', '__ID__') }}".replace('__ID__', id);
                document.getElementById('edit-category-name').value = name;
                document.getElementById('edit-category-name-en').value = document.getElementById('swal-name-en').value;
                document.getElementById('edit-category-description').value = document.getElementById('swal-description').value;
                document.getElementById('edit-category-description-en').value = document.getElementById('swal-description-en').value;
                form.submit();
            }
        });
    }
</script>
@endpush
