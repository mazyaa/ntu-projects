@extends('layouts.landing')

@section('title', $article['title'])

@section('content')
    <x-landing.page-hero
        :title="$article['title']"
        :subtitle="$article['category'] . ' — ' . $article['date'] . ' · ' . $article['reading_time'] . ' baca'"
    />

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="prose prose-lg max-w-none" data-aos="fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <a href="{{ route('articles') }}" class="text-sm text-gray-400 hover:text-primary transition-colors flex items-center gap-1">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Artikel
                    </a>
                    <span class="text-gray-300">|</span>
                    <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-bold rounded-full">{{ $article['category'] }}</span>
                    <span class="text-sm text-gray-400">{{ $article['date'] }}</span>
                    <span class="text-sm text-gray-400">· {{ $article['reading_time'] }} baca</span>
                </div>

                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-72 object-cover rounded-3xl mb-8" loading="lazy">

                <h1 class="text-3xl md:text-4xl font-bold text-secondary mb-6 leading-tight">{{ $article['title'] }}</h1>

                <div class="text-gray-600 leading-relaxed text-lg">
                    {!! $article['content'] !!}
                </div>
            </div>
        </div>
    </section>

    @if($related->count())
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-secondary mb-8" data-aos="fade-up">Artikel Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $index => $rel)
                <a href="{{ route('articles.show', $rel['slug']) }}" class="group glass-card rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ $rel['image'] }}" alt="{{ $rel['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-secondary/40 to-transparent"></div>
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-bold text-primary">{{ $rel['category'] }}</span>
                        <h3 class="text-sm font-bold text-secondary mt-1 leading-snug group-hover:text-primary transition-colors line-clamp-2">{{ $rel['title'] }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <x-landing.cta />
@endsection
