<section class="py-24 bg-slate-50 relative overflow-hidden" id="about">
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="relative" data-aos="fade-right">
                <div class="aspect-4/5 rounded-3xl overflow-hidden relative shadow-2xl shadow-gray-200/50">
                    <img src="/images/general/about-image.webp" alt="{{ __('ui.about.alt') }}" width="1200" height="1500" loading="lazy" decoding="async" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-secondary/10"></div>
                </div>

                <div class="absolute -bottom-8 -right-8 md:bottom-8 md:-right-12 glass-card p-6 rounded-2xl max-w-xs" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4">
                        <i data-lucide="flask-conical" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-lg font-bold text-secondary mb-1">{{ __('ui.about.glass_title') }}</h4>
                    <p class="text-sm text-gray-500">{{ __('ui.about.glass_text') }}</p>
                </div>
            </div>

            <div data-aos="fade-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                    <i data-lucide="info" class="w-4 h-4"></i> {{ __('ui.about.badge') }}
                </div>

                <h2 class="text-4xl md:text-5xl font-bold text-secondary tracking-tight mb-6 leading-tight">
                    <span class="text-primary">{{ __('ui.about.h2_strong') }}</span> {{ __('ui.about.h2_rest') }}
                </h2>

                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    {{ company('overview.intro') }}
                </p>

                <p class="text-gray-600 text-lg mb-10 leading-relaxed">
                    {{ company('overview.founded') }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <i data-lucide="target" class="w-6 h-6 text-primary"></i>
                            <h3 class="text-xl font-bold text-secondary">{{ __('ui.about.vision_label') }}</h3>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ company('vision') }}</p>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <i data-lucide="rocket" class="w-6 h-6 text-accent"></i>
                            <h3 class="text-xl font-bold text-secondary">{{ __('ui.about.mission_label') }}</h3>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ company('mission')[0] }}</p>
                    </div>
                </div>

                <a href="{{ lroute('about') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:text-primary/80 transition-colors group">
                    {{ __('ui.about.learn_more') }}
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

        </div>
    </div>
</section>
