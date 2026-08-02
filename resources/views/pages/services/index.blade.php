@extends('layouts.landing')

@section('title', __('ui.page_titles.services'))

@section('content')
    <x-landing.page-hero
        :title="__('ui.services_page.hero_title')"
        :subtitle="__('ui.services_page.hero_subtitle')"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $index => $service)
                @php $brandColors = ['primary' => '#0736AA', 'secondary' => '#06205E', 'accent' => '#0B9918', 'success' => '#22C55E']; @endphp
                <a href="{{ lroute('services.show', ['slug' => $service->routeSlug()]) }}" class="group glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-300 flex flex-col" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->localized('short_title') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                        <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white border border-white/30" style="background-color: {{ $brandColors[$service->color] }}">
                            <i data-lucide="{{ $service->icon }}" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $service->localized('title') }}</h3>
                        <p class="text-gray-500 text-sm mb-4 flex-1 leading-relaxed">{{ $service->localized('tagline') }}</p>
                        <span class="text-sm font-bold text-primary flex items-center gap-1">
                            {{ __('ui.services_page.learn_more') }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
