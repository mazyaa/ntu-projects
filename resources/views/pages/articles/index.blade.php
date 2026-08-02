@extends('layouts.landing')

@section('title', 'Artikel')

@section('content')
    @php
        $categories = $articles->getCollection()
            ->flatMap(fn ($article) => $article->category ? [$article->category->name] : [])
            ->unique()
            ->values()
            ->all();
    @endphp

    <x-landing.page-hero
        :title="'Artikel & Wawasan'"
        :subtitle="'Analisis kebijakan, hasil riset, dan wawasan teknis dari tim ahli NTU.'"
    />

    <section class="py-24 bg-white relative overflow-hidden" x-data="{ cat: 'Semua' }">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-3 mb-14" data-aos="fade-up">
                <button type="button" @click="cat = 'Semua'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300"
                    :class="cat === 'Semua' ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white/70 text-gray-600 hover:bg-gray-100'">
                    Semua
                </button>
                @foreach($categories as $category)
                <button type="button" @click="cat = '{{ $category }}'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300"
                    :class="cat === '{{ $category }}' ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white/70 text-gray-600 hover:bg-gray-100'">
                    {{ $category }}
                </button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $index => $article)
                <article class="glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-300 group"
                    x-show="cat === 'Semua' || cat === '{{ $article->category?->name }}'"
                    data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <a href="{{ route('articles.show', $article->slug) }}" class="block">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/60 to-transparent"></div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-primary/90 backdrop-blur-md text-white text-xs font-bold rounded-full">{{ $article->category?->name }}</span>
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 flex items-center gap-3 text-white/80 text-xs">
                                <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $article->reading_time }} menit</span>
                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> {{ $article->published_at?->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-secondary mb-3 group-hover:text-primary transition-colors leading-snug">{{ $article->title }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                            <span class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                                Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </span>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
