@extends('layouts.landing')

@section('title', $article->title)

@section('content')
    <x-landing.page-hero
        :title="$article->title"
        :subtitle="($article->category?->name ?? '') . ' — ' . $article->published_at?->format('d M Y')"
        :breadcrumb="[
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Artikel', 'url' => route('articles')],
            ['label' => $article->title],
        ]"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 min-w-0">
                    <article class="prose prose-lg max-w-none" data-aos="fade-up">
                        <div class="flex items-center gap-4 mb-8 flex-wrap">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-bold rounded-full">{{ $article->category?->name }}</span>
                            <span class="text-sm text-gray-400">{{ $article->published_at?->format('d M Y') }}</span>
                        </div>

                        @if($article->thumbnail)
                        <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-72 object-cover rounded-3xl mb-8" loading="lazy">
                        @endif

                        <h1 class="text-3xl md:text-4xl font-bold text-secondary mb-6 leading-tight">{{ $article->title }}</h1>

                        <div class="text-gray-600 leading-relaxed text-lg">
                            {!! $article->content !!}
                        </div>
                    </article>

                    <!-- Author Card -->
                    @if($article->author)
                    <div class="mt-12" data-aos="fade-up">
                        <div class="glass-card rounded-3xl p-8 overflow-hidden relative">
                            <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
                            <div class="relative flex flex-col sm:flex-row items-start sm:items-center gap-6">
                                <div class="shrink-0">
                                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-primary/20 overflow-hidden">
                                        @if($article->author->avatar)
                                            <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($article->author->name, 0, 1)) }}
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full mb-2">
                                        <i data-lucide="pen-tool" class="w-3 h-3"></i> Penulis
                                    </div>
                                    <h3 class="text-lg font-bold text-secondary leading-tight">{{ $article->author->name }}</h3>

                                    @if($article->author->skills)
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach(array_filter(array_map('trim', explode(',', $article->author->skills))) as $skill)
                                        <span class="px-2.5 py-1 bg-white/70 border border-gray-100 text-gray-500 text-xs rounded-lg">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                <div class="shrink-0 flex items-center gap-2 px-5 py-3 bg-white/80 border border-gray-100 rounded-2xl">
                                    <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                                    <div class="flex flex-col leading-tight">
                                        <span class="text-lg font-bold text-secondary">{{ number_format($authorArticleCount) }}</span>
                                        <span class="text-[11px] text-gray-400">Artikel Diterbitkan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 min-w-0">
                    <div class="lg:sticky lg:top-28" data-aos="fade-left">
                        <div class="rounded-3xl bg-slate-50 border border-gray-100 p-6">
                            <h2 class="text-xl font-bold text-secondary mb-6 flex items-center gap-2">
                                <i data-lucide="newspaper" class="w-5 h-5 text-primary"></i> Artikel Lainnya
                            </h2>

                            <div class="space-y-5">
                                @forelse($related as $rel)
                                <a href="{{ route('articles.show', $rel->slug) }}" class="group flex gap-4">
                                    <div class="w-24 h-20 shrink-0 overflow-hidden rounded-xl">
                                        @if($rel->thumbnail)
                                        <img src="{{ $rel->thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                        @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                                            <i data-lucide="image" class="w-6 h-6 text-primary/40"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="text-[11px] font-bold text-primary uppercase tracking-wide">{{ $rel->category?->name }}</span>
                                        <h3 class="text-sm font-semibold text-secondary leading-snug mt-0.5 group-hover:text-primary transition-colors line-clamp-2">{{ $rel->title }}</h3>
                                        <p class="text-xs text-gray-400 mt-1">{{ $rel->published_at?->format('d M Y') }}</p>
                                    </div>
                                </a>
                                @empty
                                <p class="text-sm text-gray-400">Belum ada artikel lainnya.</p>
                                @endforelse
                            </div>

                            <a href="{{ route('articles') }}" class="mt-6 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-primary bg-primary/10 rounded-xl hover:bg-primary/20 transition-colors">
                                Lihat Semua Artikel <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
