@php
    $icons = ['flask-conical', 'cog', 'recycle', 'shield-check', 'monitor', 'package', 'leaf', 'search', 'briefcase'];
@endphp
@extends('layouts.admin')

@section('breadcrumb')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-2xl text-secondary leading-tight tracking-tight">{{ isset($service) ? __('Edit Layanan') : __('Tambah Layanan') }}</h2>
            <p class="text-sm text-gray-500 mt-1">Lengkapi detail pilar layanan.</p>
        </div>
        <a href="{{ panel_route('services.index') }}" class="text-sm text-primary font-medium hover:underline">← Kembali</a>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ isset($service) ? panel_route('services.update', $service) : panel_route('services.store') }}">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <x-card>
                    <div class="p-6 space-y-5" x-data="{ lang: 'id' }">
                        <div class="inline-flex rounded-xl bg-gray-100 p-1">
                            <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white shadow text-secondary font-semibold' : 'text-gray-500 hover:text-secondary'"
                                    class="px-4 py-1.5 text-sm rounded-lg transition-colors">Indonesia</button>
                            <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white shadow text-secondary font-semibold' : 'text-gray-500 hover:text-secondary'"
                                    class="px-4 py-1.5 text-sm rounded-lg transition-colors">English</button>
                        </div>

                        <div x-show="lang === 'id'">
                            <div>
                                <label class="block text-sm font-medium text-secondary mb-2">Judul Layanan</label>
                                <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required
                                       class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                @error('title') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2">Judul Singkat</label>
                                    <input type="text" name="short_title" value="{{ old('short_title', $service->short_title ?? '') }}"
                                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2">Tagline</label>
                                    <input type="text" name="tagline" value="{{ old('tagline', $service->tagline ?? '') }}"
                                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                </div>
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-secondary mb-2">Deskripsi</label>
                                <textarea name="description" rows="4"
                                          class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">{{ old('description', $service->description ?? '') }}</textarea>
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-secondary mb-3">Lingkup Layanan</label>
                                <div id="service-items-container" class="space-y-3">
                                    @php
                                        $items = old('service_items', $service->service_items ?? []);
                                    @endphp
                                    @forelse ($items as $item)
                                        <div class="flex items-center gap-2">
                                            <input type="text" name="service_items[]" value="{{ $item }}" class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="flex items-center gap-2">
                                            <input type="text" name="service_items[]" placeholder="Item lingkup layanan..." class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    @endforelse
                                </div>
                                <button type="button" onclick="addServiceItem()" class="mt-3 inline-flex items-center gap-1 text-sm text-primary font-medium hover:underline">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Item
                                </button>
                            </div>
                        </div>

                        <div x-show="lang === 'en'" style="display: none;">
                            <div>
                                <label class="block text-sm font-medium text-secondary mb-2">English Title</label>
                                <input type="text" name="title_en" value="{{ old('title_en', $service->title_en ?? '') }}"
                                       class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                @error('title_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2">English Short Title</label>
                                    <input type="text" name="short_title_en" value="{{ old('short_title_en', $service->short_title_en ?? '') }}"
                                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2">English Tagline</label>
                                    <input type="text" name="tagline_en" value="{{ old('tagline_en', $service->tagline_en ?? '') }}"
                                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                </div>
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-secondary mb-2">English Description</label>
                                <textarea name="description_en" rows="4"
                                          class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">{{ old('description_en', $service->description_en ?? '') }}</textarea>
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-secondary mb-2">English Slug <span class="text-gray-400 font-normal">(opsional)</span></label>
                                <input type="text" name="slug_en" value="{{ old('slug_en', $service->slug_en ?? '') }}"
                                       class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 font-mono" placeholder="service-title">
                                <p class="text-xs text-gray-400 mt-1">Kosongkan untuk membuat otomatis dari judul Inggris.</p>
                                @error('slug_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-secondary mb-3">English Scope of Services</label>
                                <div id="service-items-en-container" class="space-y-3">
                                    @php
                                        $enItems = old('service_items_en', $service->service_items_en ?? []);
                                    @endphp
                                    @forelse ($enItems as $item)
                                        <div class="flex items-center gap-2">
                                            <input type="text" name="service_items_en[]" value="{{ $item }}" class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="flex items-center gap-2">
                                            <input type="text" name="service_items_en[]" placeholder="Service scope item..." class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    @endforelse
                                </div>
                                <button type="button" onclick="addServiceItemEn()" class="mt-3 inline-flex items-center gap-1 text-sm text-primary font-medium hover:underline">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Item
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">Gambar URL</label>
                            <input type="text" name="image" value="{{ old('image', $service->image ?? '') }}" placeholder="/images/services-images/....webp"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                            <p class="text-xs text-gray-400 mt-1">Gunakan path aset publik atau URL lengkap.</p>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="space-y-6">
                <x-card>
                    <div class="p-6 space-y-5">
                        <h3 class="text-base font-bold text-secondary">Pengaturan</h3>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">Ikon (Lucide)</label>
                            <div class="flex flex-wrap gap-2" x-data="{ icon: '{{ old('icon', $service->icon ?? 'flask-conical') }}' }">
                                @foreach($icons as $icon)
                                    <button type="button" @click="icon = '{{ $icon }}'"
                                            :class="icon === '{{ $icon }}' ? 'bg-primary text-white border-primary' : 'bg-gray-50 text-gray-500 border-gray-200 hover:border-primary/40'"
                                            class="p-2.5 rounded-lg border transition-colors">
                                        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                                    </button>
                                @endforeach
                                <input type="hidden" name="icon" :value="icon">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">Warna</label>
                            <select name="color" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                @foreach(['primary' => 'Primary', 'secondary' => 'Secondary', 'accent' => 'Accent', 'success' => 'Success', 'warning' => 'Warning', 'danger' => 'Danger'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('color', $service->color ?? '') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">Status</label>
                            <select name="status" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                @foreach(\App\Enums\ServiceStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', $service->status->value ?? '') === $status->value)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">Urutan</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        </div>

                        <div class="flex items-center gap-3 justify-end">
                            <a href="{{ panel_route('services.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Simpan</button>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function addServiceItem() {
        const container = document.getElementById('service-items-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `<input type="text" name="service_items[]" placeholder="Item lingkup layanan..." class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors"><i data-lucide="x" class="w-4 h-4"></i></button>`;
        container.appendChild(div);
    }

    function addServiceItemEn() {
        const container = document.getElementById('service-items-en-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `<input type="text" name="service_items_en[]" placeholder="Service scope item..." class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
            <button type="button" onclick="this.parentElement.remove()" class="p-2 rounded-lg text-gray-400 hover:text-danger hover:bg-red-50 transition-colors"><i data-lucide="x" class="w-4 h-4"></i></button>`;
        container.appendChild(div);
    }
</script>
@endpush
