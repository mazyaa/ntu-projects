@props(['title', 'subtitle' => null, 'back' => null])

<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            @if($back)
                <a href="{{ $back }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:underline mb-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                </a>
            @endif
            <h2 class="font-semibold text-2xl text-secondary leading-tight tracking-tight">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        @if(isset($actions))
            <div class="flex items-center gap-3 shrink-0">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
