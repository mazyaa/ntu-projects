@props(['person', 'delay' => 0])

@php
    $slug = $person->slug ?? $person['slug'] ?? '';
    $image = $person->image ?? $person['image'] ?? '';
    $name = $person->name ?? $person['name'] ?? '';
    $position = $person->short_position ?? $person->position ?? $person['position'] ?? '';
    $bio = $person->short_bio ?? $person->intro ?? $person['intro'] ?? '';
@endphp

<a href="{{ lroute('leadership.show', ['slug' => $slug]) }}" class="group block glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="relative aspect-2/3 overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $name }}" loading="lazy" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700 ease-out">
        <div class="absolute inset-0 bg-linear-to-t from-white via-white/20 to-transparent"></div>
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 inline-flex items-center px-3 py-1 bg-white/90 backdrop-blur-md text-secondary text-xs font-bold rounded-full shadow whitespace-nowrap">
            {{ $position }}
        </div>
    </div>
    <div class="p-6 text-center">
        <h3 class="text-xl font-bold text-secondary mb-2 group-hover:text-primary transition-colors">{{ $name }}</h3>
        <p class="text-sm text-gray-400 leading-relaxed line-clamp-2 mb-4">{{ $bio }}</p>
        <div class="inline-flex items-center gap-1 text-sm font-bold text-primary transition-all duration-300 group-hover:gap-2">
            {{ __('ui.person_card.view_profile') }} <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
        </div>
    </div>
</a>
