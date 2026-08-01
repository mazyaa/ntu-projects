<section class="py-24 bg-slate-50 relative overflow-hidden" id="artikel">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="file-text" class="w-4 h-4"></i> Artikel & Wawasan
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Artikel & Wawasan dari Tim NTU</h2>
                <p class="text-gray-500">Bacaan seputar riset terapan, kajian kebijakan, dan teknologi — disusun oleh tim ahli NTU untuk Anda.</p>
            </div>
            <a href="{{ route('articles') }}" class="inline-flex items-center text-primary font-bold hover:text-primary/80 transition-colors group">
                Lihat Semua
                <i data-lucide="arrow-right" class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(config('company-insights.articles') as $index => $article)
            @if($index < 3)
            <article class="glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                    <div class="absolute inset-0 bg-linear-to-t from-secondary/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-primary/90 backdrop-blur-md text-white text-xs font-bold rounded-full">{{ $article['category'] }}</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 flex items-center gap-3 text-white/80 text-xs">
                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $article['reading_time'] }} baca</span>
                        <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> {{ $article['date'] }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-secondary mb-3 group-hover:text-primary transition-colors leading-snug">{{ $article['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $article['excerpt'] }}</p>
                    <a href="{{ route('articles.show', $article['slug']) }}" class="text-sm font-bold text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                        Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </article>
            @endif
            @endforeach
        </div>
    </div>
</section>
