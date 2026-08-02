@props(['variant' => 'auto', 'class' => ''])

@php
    $currentLocale = app()->getLocale();
@endphp

<div class="relative shrink-0 {{ $class }}"
     x-data="languageSwitcher({ initial: '{{ $currentLocale }}' })">
    <button type="button"
            @click="open = !open"
            @keydown.escape.window="open = false"
            aria-haspopup="listbox"
            :aria-expanded="open"
            :aria-label="open ? @js(__('ui.switcher.close_aria')) : @js(__('ui.switcher.open_aria'))"
            class="inline-flex items-center gap-2 rounded-full border px-3 py-2 text-sm font-medium transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
            :class="({{ $variant === 'light' ? 'true' : 'scrolled' }}) ? 'border-gray-200 bg-white/80 text-gray-700 hover:border-primary/40 hover:bg-primary/5' : 'border-white/25 text-white hover:bg-white/10'">
        <span class="inline-flex" x-show="currentLocale === 'id'">
            <x-landing.flag code="id" />
        </span>
        <span class="inline-flex" x-show="currentLocale === 'en'" style="display: none;">
            <x-landing.flag code="en" />
        </span>
        <span class="hidden sm:inline" x-text="currentLocale === 'id' ? @js(__('ui.switcher.label_id')) : @js(__('ui.switcher.label_en'))"></span>
        <span class="inline-flex transition-transform duration-200" :class="open ? 'rotate-180' : ''">
            <i data-lucide="chevron-down" class="w-4 h-4"></i>
        </span>
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
         @click.outside="open = false"
         role="listbox"
         aria-label="{{ __('ui.switcher.menu_aria') }}"
         class="absolute right-0 mt-2 w-44 rounded-2xl border border-gray-100 bg-white p-1.5 shadow-xl"
         style="display: none;">
        <button type="button"
                role="option"
                :aria-selected="currentLocale === 'id'"
                @click="switchTo('id')"
                :class="currentLocale === 'id' ? 'bg-primary/5 text-primary' : 'text-gray-600 hover:bg-primary/5 hover:text-primary'"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-left text-sm font-medium transition-colors">
            <x-landing.flag code="id" />
            <span class="flex-1">{{ __('ui.switcher.label_id') }}</span>
            <span class="inline-flex" :class="currentLocale === 'id' ? '' : 'opacity-0'">
                <i data-lucide="check" class="w-4 h-4"></i>
            </span>
        </button>
        <button type="button"
                role="option"
                :aria-selected="currentLocale === 'en'"
                @click="switchTo('en')"
                :class="currentLocale === 'en' ? 'bg-primary/5 text-primary' : 'text-gray-600 hover:bg-primary/5 hover:text-primary'"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-left text-sm font-medium transition-colors">
            <x-landing.flag code="en" />
            <span class="flex-1">{{ __('ui.switcher.label_en') }}</span>
            <span class="inline-flex" :class="currentLocale === 'en' ? '' : 'opacity-0'">
                <i data-lucide="check" class="w-4 h-4"></i>
            </span>
        </button>
    </div>
</div>
