<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Main -->
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
                        <label class="block text-sm font-medium text-secondary mb-2" for="title">Judul Artikel</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Judul artikel...">
                        @error('title') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="slug">Slug</label>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400">/</span>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug ?? '') }}" required
                                   class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 font-mono" placeholder="judul-artikel">
                        </div>
                        @error('slug') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="excerpt">Ringkasan (Excerpt)</label>
                        <textarea id="excerpt" name="excerpt" rows="3"
                                  class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                        @error('excerpt') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="content">Konten</label>
                        <x-admin.rich-editor
                            name="content"
                            id="content"
                            :value="old('content', $article->content ?? '')"
                            upload-url="{{ panel_route('articles.upload-image') }}"
                        />
                        @error('content') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-show="lang === 'en'" style="display: none;">
                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="title_en">English Title</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $article->title_en ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Article title...">
                        @error('title_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="slug_en">English Slug</label>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400">/en/artikel/</span>
                            <input type="text" id="slug_en" name="slug_en" value="{{ old('slug_en', $article->slug_en ?? '') }}"
                                   class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 font-mono" placeholder="article-title">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Kosongkan untuk membuat otomatis dari judul Inggris.</p>
                        @error('slug_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="excerpt_en">English Excerpt</label>
                        <textarea id="excerpt_en" name="excerpt_en" rows="3"
                                  class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Short article summary...">{{ old('excerpt_en', $article->excerpt_en ?? '') }}</textarea>
                        @error('excerpt_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-secondary mb-2" for="content_en">English Content</label>
                        <x-admin.rich-editor
                            name="content_en"
                            id="content_en"
                            :value="old('content_en', $article->content_en ?? '')"
                            upload-url="{{ panel_route('articles.upload-image') }}"
                        />
                        @error('content_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Gambar -->
        <x-card>
            <div class="p-6">
                <h3 class="text-base font-bold text-secondary mb-4">Gambar</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="thumbnail">Thumbnail</label>
                        <div class="flex items-center gap-2">
                            <input type="text" id="thumbnail" name="thumbnail" value="{{ old('thumbnail', $article->thumbnail ?? '') }}"
                                   class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="URL thumbnail atau upload">
                            <button type="button" data-upload-target="thumbnail"
                                    class="px-3 py-2.5 text-sm font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors whitespace-nowrap"
                                    title="Upload Thumbnail">
                                <i data-lucide="upload" class="w-4 h-4"></i>
                            </button>
                            <input type="file" accept="image/*" class="hidden" data-file-input="thumbnail">
                        </div>
                        <div class="mt-3" data-preview="thumbnail" @if(empty($article->thumbnail ?? '') && !old('thumbnail')) style="display:none" @endif>
                            <img src="{{ old('thumbnail', $article->thumbnail ?? '') }}" alt="Thumbnail preview" class="h-24 w-full object-cover rounded-lg border border-gray-200">
                        </div>
                        @error('thumbnail') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary mb-2" for="cover">Cover URL</label>
                        <input type="text" id="cover" name="cover" value="{{ old('cover', $article->cover ?? '') }}"
                               class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="opsional">
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    <div class="space-y-6">
        <!-- Publish -->
        <x-card>
            <div class="p-6 space-y-5">
                <h3 class="text-base font-bold text-secondary">Publikasi</h3>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="status">Status</label>
                    <select id="status" name="status" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="draft" @selected(old('status', $article->status->value ?? 'draft') === 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $article->status->value ?? '') === 'published')>Published (Langsung)</option>
                    </select>
                    @error('status') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="scheduled_at">Jadwal Publikasi</label>
                    <input type="datetime-local" id="scheduled_at" name="scheduled_at"
                           value="{{ old('scheduled_at', $article->scheduled_at ?? '') }}"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                    <p class="text-xs text-gray-400 mt-1">Isi tanggal masa depan untuk menjadwalkan publikasi otomatis. Kosongkan untuk langsung draft/published.</p>
                    @error('scheduled_at') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured ?? false))
                           class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                    <span class="ml-2 text-sm text-gray-600">Jadikan Artikel Unggulan</span>
                </label>
            </div>
        </x-card>

        <!-- Category & Tags -->
        <x-card>
            <div class="p-6 space-y-5">
                <h3 class="text-base font-bold text-secondary">Kategori & Tag</h3>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="">— Pilih Kategori —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id ?? '') === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-secondary mb-2" for="tags">Tag (pisahkan dengan koma)</label>
                    @php
                        $tagsValue = is_array(old('tags'))
                            ? implode(', ', old('tags'))
                            : old('tags', isset($article) && $article->tags->count() ? $article->tags->pluck('name')->join(', ') : '');
                    @endphp
                    <input type="text" id="tags" name="tags[]"
                           value="{{ $tagsValue }}"
                           class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="kebijakan, riset, K3">
                    @error('tags') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </x-card>

        <div class="flex items-center gap-3 justify-end">
            <a href="{{ panel_route('articles.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                {{ isset($article) ? 'Simpan Perubahan' : 'Buat Artikel' }}
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-upload-target]').forEach((button) => {
            const target = button.dataset.uploadTarget;
            const fileInput = button.parentElement.querySelector(`[data-file-input="${target}"]`);
            const previewWrap = document.querySelector(`[data-preview="${target}"]`);
            const previewImg = previewWrap ? previewWrap.querySelector('img') : null;

            button.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', async (event) => {
                const file = event.target.files[0];
                if (!file) return;

                const form = new FormData();
                form.append('thumbnail', file);

                try {
                    const res = await fetch('{{ panel_route('articles.upload-thumbnail') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: form,
                    });

                    const data = await res.json();

                    if (!res.ok) {
                        alert(data.error || 'Gagal mengunggah thumbnail.');
                        return;
                    }

                    document.querySelector(`#${target}`).value = data.url;

                    if (previewImg) {
                        previewImg.src = data.url;
                        previewWrap.style.display = 'block';
                    }
                } catch (e) {
                    alert('Terjadi kesalahan saat mengunggah thumbnail.');
                } finally {
                    event.target.value = '';
                }
            });
        });
    });
</script>
@endpush
