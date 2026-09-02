<form method="POST" action="{{ isset($member) ? panel_route('team.update', $member) : panel_route('team.store') }}">
    @csrf
    @if(isset($member)) @method('PUT') @endif

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
                            <label class="block text-sm font-medium text-secondary mb-2">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" required
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">Jabatan</label>
                            <input type="text" name="position" value="{{ old('position', $member->position ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">Bio Singkat</label>
                            <textarea name="short_bio" rows="3"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('short_bio', $member->short_bio ?? '') }}</textarea>
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">Bio Lengkap</label>
                            <textarea name="bio" rows="6"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('bio', $member->bio ?? '') }}</textarea>
                        </div>
                    </div>

                    <div x-show="lang === 'en'" style="display: none;">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2">English Name</label>
                            <input type="text" name="name_en" value="{{ old('name_en', $member->name_en ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">English Position</label>
                            <input type="text" name="position_en" value="{{ old('position_en', $member->position_en ?? '') }}"
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">English Short Bio</label>
                            <textarea name="short_bio_en" rows="3"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('short_bio_en', $member->short_bio_en ?? '') }}</textarea>
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-secondary mb-2">English Full Bio</label>
                            <textarea name="bio_en" rows="6"
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">{{ old('bio_en', $member->bio_en ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="space-y-6">
            <x-card>
                <div class="p-6 space-y-5">
                    <h3 class="text-base font-bold text-secondary">Pengaturan</h3>

                    <x-admin.media-picker name="photo" :value="$member->photo ?? null" label="Foto Profil" />

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Status</label>
                        <select name="is_active" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <option value="1" @selected(old('is_active', $member->is_active ?? true) == 1)>Aktif</option>
                            <option value="0" @selected(old('is_active', $member->is_active ?? true) == 0)>Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-secondary">Unggulan</label>
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $member->is_featured ?? 0) ? 'checked' : '' }}
                               class="w-5 h-5 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary/20 cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2">Urutan</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" min="0"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                    </div>

                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ panel_route('team.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90">Simpan</button>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</form>
