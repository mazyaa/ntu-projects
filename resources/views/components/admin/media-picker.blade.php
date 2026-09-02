@props([
    'name',
    'value' => null,
    'label' => 'Gambar',
    'accept' => 'image/*',
    'maxSize' => '5MB',
])

@php
    $inputId = 'media-picker-' . Str::random(8);
    $initialPreview = $value ? (str_starts_with($value, 'http') ? $value : asset('storage/' . ltrim($value, '/'))) : null;
@endphp

<div x-data="mediaPicker('{{ $inputId }}', '{{ $initialPreview ?? '' }}')" class="space-y-2">
    <label class="block text-sm font-medium text-secondary">{{ $label }}</label>

    {{-- Preview --}}
    <div class="relative group" x-show="previewUrl" x-cloak>
        <div class="w-full h-40 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
            <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover">
        </div>
        <button type="button" @click="clearSelection()"
                class="absolute top-2 right-2 p-1.5 bg-white/90 rounded-lg shadow hover:bg-red-50 text-gray-400 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-2" x-show="!previewUrl">
        <label for="{{ $inputId }}-upload"
               class="flex-1 flex items-center justify-center gap-2 px-4 py-8 border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:border-primary/40 hover:bg-primary/5 transition-colors">
            <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-300"></i>
            <div class="text-center">
                <p class="text-sm font-medium text-gray-500">Klik untuk upload</p>
                <p class="text-xs text-gray-400 mt-0.5">Maks {{ $maxSize }}, otomatis dikonversi WebP</p>
            </div>
        </label>
        <input type="file" id="{{ $inputId }}-upload" class="hidden"
               accept="{{ $accept }}"
               x-on:change="uploadFile($event.target.files[0])">
    </div>

    {{-- Direct URL input (fallback) --}}
    <div x-show="!previewUrl" class="flex items-center gap-2">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400 shrink-0">atau</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>
    <div x-show="!previewUrl" class="flex gap-2">
        <input type="text" name="{{ $name }}" value="{{ $value }}"
               placeholder="Tempel URL gambar..."
               x-model="manualUrl"
               @blur="if(manualUrl) { previewUrl = manualUrl; $refs.hiddenInput.value = manualUrl; }"
               class="flex-1 py-2 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
    </div>

    {{-- Hidden input for form submission --}}
    <input type="hidden" name="{{ $name }}" x-ref="hiddenInput" value="{{ $value }}">

    {{-- Upload loading indicator --}}
    <div x-show="uploading" class="flex items-center gap-2 text-sm text-primary" x-cloak>
        <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
        Mengunggah & mengoptimasi...
    </div>

    {{-- Error --}}
    <p x-show="error" x-text="error" class="text-xs text-danger" x-cloak></p>
</div>

@push('scripts')
<script>
function mediaPicker(id, initial) {
    return {
        previewUrl: initial || '',
        manualUrl: '',
        uploading: false,
        error: '',

        async uploadFile(file) {
            if (!file) return;
            this.error = '';
            this.uploading = true;

            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch('{{ panel_route("media.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok) {
                    this.previewUrl = data.url;
                    this.$refs.hiddenInput.value = data.path;
                } else {
                    this.error = data.message || 'Gagal mengunggah file.';
                }
            } catch (e) {
                this.error = 'Terjadi kesalahan saat mengunggah.';
            } finally {
                this.uploading = false;
            }
        },

        clearSelection() {
            this.previewUrl = '';
            this.manualUrl = '';
            this.$refs.hiddenInput.value = '';
        }
    };
}
</script>
@endpush
