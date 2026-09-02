<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="award" class="w-4 h-4"></i> {{ __('ui.why_ntu.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.why_ntu.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.why_ntu.subtitle') }}</p>
        </div>

        <!-- Reason Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(__('ui.why_ntu.reasons') as $index => $reason)
            <div class="group relative bg-slate-50 p-8 rounded-3xl border border-gray-100 hover:border-primary/30 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <!-- Gradient overlay on hover -->
                <div class="absolute inset-0 rounded-3xl bg-linear-to-br from-primary/5 to-accent/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <div class="relative">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-gray-100 mb-6 group-hover:bg-primary group-hover:text-white group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i data-lucide="{{ ['users', 'book-open', 'scan-eye', 'clipboard-check', 'file-text'][$index] }}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-3 group-hover:text-primary transition-colors duration-300">{{ $reason['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $reason['text'] }}</p>
                </div>
            </div>
            @endforeach

            <!-- CTA Card -->
            <div class="relative bg-primary p-8 rounded-3xl shadow-xl shadow-primary/20 flex flex-col justify-center items-center text-center overflow-hidden group hover:scale-105 transition-transform duration-500" data-aos="fade-up" data-aos-delay="600">
                <div class="absolute inset-0 bg-linear-to-br from-primary to-secondary opacity-90"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-white mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="phone" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">{{ __('ui.cta.h2_line1') }}?</h3>
                    <p class="text-white/80 text-sm mb-6">{{ __('ui.cta.subtitle') }}</p>
                    <a href="{{ lroute('contact') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-primary bg-white rounded-xl hover:bg-gray-50 transition-all duration-300 group-hover:shadow-lg">
                        {{ __('ui.cta.primary') }}
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
