<section class="py-24 bg-white relative overflow-hidden" id="pengalaman">
    <div class="absolute -top-24 right-0 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                <i data-lucide="building-2" class="w-4 h-4"></i> {{ __('ui.experience.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.experience.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.experience.subtitle') }}</p>
        </div>

        <div class="space-y-6 max-w-4xl mx-auto">
            @foreach(company('projects', 'company-experience') as $index => $project)
            <div class="group relative flex items-start gap-6 p-6 glass-card rounded-2xl hover:shadow-xl hover:shadow-primary/5 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="shrink-0 w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <i data-lucide="{{ $project['icon'] }}" class="w-6 h-6"></i>
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <span class="px-2.5 py-1 bg-accent/10 text-accent text-xs font-bold rounded-full">{{ $project['category'] }}</span>
                        <span class="text-sm text-gray-400 font-medium">{{ $project['year'] }}</span>
                    </div>
                    <h3 class="text-base font-bold text-secondary mb-2 leading-snug">{{ $project['title'] }}</h3>
                    <p class="text-sm text-gray-400">{{ $project['institution'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
