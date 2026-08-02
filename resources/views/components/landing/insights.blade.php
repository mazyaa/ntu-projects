<section class="py-24 bg-slate-50 relative overflow-hidden" id="artikel">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="file-text" class="w-4 h-4"></i> {{ __('ui.insights.badge') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.insights.h2') }}</h2>
                <p class="text-gray-500">{{ __('ui.insights.subtitle') }}</p>
            </div>
            <a href="{{ lroute('articles') }}" class="inline-flex items-center text-primary font-bold hover:text-primary/80 transition-colors group">
                {{ __('ui.insights.view_all') }}
                <i data-lucide="arrow-right" class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Article::published()->with('category')->latest('published_at')->take(3)->get() as $index => $article)
            <article class="glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $article->thumbnail }}" alt="{{ $article->localized('title') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-primary/90 backdrop-blur-md text-white text-xs font-bold rounded-full">{{ $article->category?->localized('name') }}</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 flex items-center gap-3 text-white/80 text-xs">
                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $article->reading_time }} {{ __('ui.insights.minutes') }}</span>
                        <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> {{ $article->published_at?->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-secondary mb-3 group-hover:text-primary transition-colors leading-snug">{{ $article->localized('title') }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $article->localized('excerpt') }}</p>
                    <a href="{{ lroute('articles.show', ['slug' => $article->routeSlug()]) }}" class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                        {{ __('ui.insights.read_more') }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
