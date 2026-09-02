<section class="py-24 bg-slate-50 relative overflow-hidden cv-auto" id="industries">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                <i data-lucide="building-2" class="w-4 h-4"></i> {{ __('ui.industries.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.industries.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.industries.subtitle') }}</p>
        </div>

        @php
            $industryImages = [
                'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1553413077-190dd305871c?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop',
                'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=600&h=400&fit=crop',
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(__('ui.industries.list') as $index => $industry)
            <div class="group relative rounded-3xl overflow-hidden aspect-4/3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <img src="{{ $industryImages[$index] }}" alt="{{ $industry['name'] }}" width="600" height="400" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-secondary/90 via-secondary/40 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-end p-6 text-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white mb-3 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                        <i data-lucide="{{ $industry['icon'] }}" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-sm font-bold text-white">{{ $industry['name'] }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
