@props(['name' => 'content', 'id' => 'content', 'value' => '', 'uploadUrl' => null])

<div
    x-data="richEditor()"
    x-init="init($refs.editor, '{{ $value }}')"
    class="rich-editor"
>
    <input type="hidden" id="{{ $id }}" name="{{ $name }}" x-model="html">

    <!-- Toolbar -->
    <div class="flex flex-wrap items-center gap-1 p-2 bg-gray-50 border border-gray-200 border-b-0 rounded-t-xl">
        <button type="button" data-cmd="bold" @click.prevent="exec('bold')" class="rich-btn" title="Tebal">
            <i data-lucide="bold" class="w-4 h-4"></i>
        </button>
        <button type="button" data-cmd="italic" @click.prevent="exec('italic')" class="rich-btn" title="Miring">
            <i data-lucide="italic" class="w-4 h-4"></i>
        </button>
        <button type="button" data-cmd="underline" @click.prevent="exec('underline')" class="rich-btn" title="Garis Bawah">
            <i data-lucide="underline" class="w-4 h-4"></i>
        </button>
        <span class="w-px h-5 bg-gray-200 mx-1"></span>
        <button type="button" data-cmd="formatBlock" @click.prevent="exec('formatBlock', 'H2')" class="rich-btn" title="Judul">
            <span class="text-xs font-bold">H2</span>
        </button>
        <button type="button" data-cmd="formatBlock" @click.prevent="exec('formatBlock', 'BLOCKQUOTE')" class="rich-btn" title="Kutipan">
            <i data-lucide="quote" class="w-4 h-4"></i>
        </button>
        <span class="w-px h-5 bg-gray-200 mx-1"></span>
        <button type="button" data-cmd="insertUnorderedList" @click.prevent="exec('insertUnorderedList')" class="rich-btn" title="Daftar Bullet">
            <i data-lucide="list" class="w-4 h-4"></i>
        </button>
        <button type="button" data-cmd="insertOrderedList" @click.prevent="exec('insertOrderedList')" class="rich-btn" title="Daftar Nomor">
            <i data-lucide="list-ordered" class="w-4 h-4"></i>
        </button>
        <span class="w-px h-5 bg-gray-200 mx-1"></span>
        <button type="button" @click.prevent="addLink" class="rich-btn" title="Sisipkan Link">
            <i data-lucide="link-2" class="w-4 h-4"></i>
        </button>
        @if($uploadUrl)
        <button type="button" @click.prevent="pickImage" class="rich-btn" title="Upload Gambar">
            <i data-lucide="image-plus" class="w-4 h-4"></i>
        </button>
        @endif
        <input type="file" accept="image/*" class="hidden" x-ref="fileInput" @change="uploadImage($event)">

        <span class="flex-1"></span>
        <button type="button" @click.prevent="exec('undo')" class="rich-btn text-gray-400 hover:text-gray-600" title="Undo">
            <i data-lucide="undo-2" class="w-4 h-4"></i>
        </button>
        <button type="button" @click.prevent="exec('redo')" class="rich-btn text-gray-400 hover:text-gray-600" title="Redo">
            <i data-lucide="redo-2" class="w-4 h-4"></i>
        </button>
    </div>

    <!-- Editor -->
    <div
        x-ref="editor"
        contenteditable="true"
        data-placeholder="Tulis konten artikel di sini..."
        class="rich-content w-full min-h-[360px] px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-b-xl focus:outline-none focus:ring-2 focus:ring-primary/20 overflow-y-auto leading-relaxed"
        @input="html = $refs.editor.innerHTML"
    ></div>

    <p class="text-xs text-gray-400 mt-1">Gunakan toolbar untuk memformat konten. Gambar yang diunggah akan disisipkan otomatis.</p>
</div>

<style>
    .rich-editor .rich-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.5rem;
        color: #6b7280;
        transition: color 0.2s ease, background-color 0.2s ease;
    }
    .rich-editor .rich-btn:hover {
        color: var(--color-primary);
        background-color: #ffffff;
    }
    .rich-content:empty::before {
        content: attr(data-placeholder);
        color: #9ca3af;
        pointer-events: none;
        display: block;
    }
    .rich-content img {
        max-width: 100%;
        border-radius: 0.75rem;
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .rich-content blockquote {
        border-left: 4px solid rgba(7, 54, 170, 0.3);
        padding-left: 1rem;
        color: #6b7280;
        font-style: italic;
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .rich-content h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-secondary);
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .rich-content a {
        color: var(--color-primary);
        text-decoration: underline;
    }
</style>

@push('scripts')
<script>
    function richEditor() {
        return {
            html: '',
            editing: null,

            init(editor, value) {
                this.editing = editor;
                editor.innerHTML = value || '';
                this.html = value || '';
            },

            exec(command, value = null) {
                document.execCommand(command, false, value);
                this.html = this.editing.innerHTML;
            },

            addLink() {
                const url = prompt('Masukkan URL link:');
                if (!url) return;
                this.exec('createLink', url);
            },

            pickImage() {
                this.$refs.fileInput.click();
            },

            async uploadImage(event) {
                const file = event.target.files[0];
                if (!file) return;

                const form = new FormData();
                form.append('image', file);

                try {
                    const res = await fetch('{{ $uploadUrl }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: form,
                    });

                    const data = await res.json();

                    if (!res.ok) {
                        alert(data.error || 'Gagal mengunggah gambar.');
                        return;
                    }

                    this.exec('insertImage', data.url);
                } catch (e) {
                    alert('Terjadi kesalahan saat mengunggah gambar.');
                } finally {
                    event.target.value = '';
                }
            },
        };
    }
</script>
@endpush
