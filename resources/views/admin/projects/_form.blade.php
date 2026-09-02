<form method="POST" action="{{ isset($project) ? panel_route('projects.update', $project) : panel_route('projects.store') }}">
    @csrf
    @if(isset($project)) @method('PUT') @endif

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
                            <label class="block text-sm font-medium text-secondary mb-2">Judul Proyek</label>
                            <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            @error('title') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('description', $project->description ?? '') }}</textarea>
                        </div>
                    </div>

                    <div x-show="lang === 'en'" style="display: none;">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">English Title</label>
                            <input type="text" name="title_en" value="{{ old('title_en', $project->title_en ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">English Description</label>
                            <textarea name="description_en" rows="4"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('description_en', $project->description_en ?? '') }}</textarea>
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
                        <label class="block text-sm font-medium text-secondary mb-2">Klien</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $project->client_name ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $project->location ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Tahun</label>
                        <input type="text" name="year" value="{{ old('year', $project->year ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $project->category ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <x-admin.media-picker name="featured_image" :value="$project->featured_image ?? null" label="Gambar Proyek" />

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Unggulan</label>
                        <select name="is_featured" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <option value="0" @selected(old('is_featured', $project->is_featured ?? false) == 0)>Tidak</option>
                            <option value="1" @selected(old('is_featured', $project->is_featured ?? false) == 1)>Ya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Status Publikasi</label>
                        <select name="is_published" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <option value="0" @selected(old('is_published', $project->is_published ?? false) == 0)>Draft</option>
                            <option value="1" @selected(old('is_published', $project->is_published ?? false) == 1)>Dipublikasikan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Urutan</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ panel_route('projects.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Simpan</button>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</form>
