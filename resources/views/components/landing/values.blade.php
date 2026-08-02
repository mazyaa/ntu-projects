<section class="py-24 bg-slate-50 relative overflow-hidden" id="values">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="heart" class="w-4 h-4"></i> {{ __('ui.values.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.values.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.values.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
                $delays = [100, 200, 300, 400, 500];
            @endphp
            @foreach(company('values') as $index => $value)
            <div class="group relative glass-card rounded-3xl p-8 text-center hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $delays[$index] }}">
                <div class="absolute inset-0 rounded-3xl bg-linear-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-{{ $value['color'] }}/10 rounded-2xl flex items-center justify-center text-{{ $value['color'] }} mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="{{ $value['icon'] }}" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-3">{{ $value['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $value['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
