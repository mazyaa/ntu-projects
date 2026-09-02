<form method="POST" action="{{ isset($item) ? panel_route('equipment.update', $item) : panel_route('equipment.store') }}">
    @csrf
    @if(isset($item)) @method('PUT') @endif

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
                            <label class="block text-sm font-medium text-secondary mb-2">Nama Peralatan</label>
                            <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('description', $item->description ?? '') }}</textarea>
                        </div>
                    </div>

                    <div x-show="lang === 'en'" style="display: none;">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">English Name</label>
                            <input type="text" name="name_en" value="{{ old('name_en', $item->name_en ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">English Description</label>
                            <textarea name="description_en" rows="4"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('description_en', $item->description_en ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="space-y-6">
            <x-card>
                <div class="p-6 space-y-5">
                    <h3 class="text-base font-bold text-secondary">Detail</h3>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $item->category ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Merk</label>
                        <input type="text" name="brand" value="{{ old('brand', $item->brand ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Model</label>
                        <input type="text" name="model" value="{{ old('model', $item->model ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Kapasitas</label>
                        <input type="text" name="capacity" value="{{ old('capacity', $item->capacity ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Satuan</label>
                        <input type="text" name="unit" value="{{ old('unit', $item->unit ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <x-admin.media-picker name="image" :value="$item->image ?? null" label="Gambar Peralatan" />

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Status</label>
                        <select name="is_active" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <option value="1" @selected(old('is_active', $item->is_active ?? true) == 1)>Aktif</option>
                            <option value="0" @selected(old('is_active', $item->is_active ?? true) == 0)>Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ panel_route('equipment.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Simpan</button>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</form>
