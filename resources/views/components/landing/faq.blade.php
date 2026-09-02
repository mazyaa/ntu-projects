<section class="py-24 bg-slate-50 relative overflow-x-clip" id="faq">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-32 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="help-circle" class="w-4 h-4"></i> {{ __('ui.faq.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.faq.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.faq.subtitle') }}</p>
        </div>

        <div class="space-y-4" x-data="{ active: null }">
            @foreach(company(null, 'company-faq') as $index => $faq)
            <div class="glass-card rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <button @click="active = active === {{ $index + 1 }} ? null : {{ $index + 1 }}" class="w-full flex items-center justify-between p-6 text-left font-bold text-secondary hover:text-primary transition-colors" :class="active === {{ $index + 1 }} ? 'text-primary' : ''">
                    <span class="pr-4">{{ $faq['question'] }}</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 shrink-0 transition-transform duration-300" :class="active === {{ $index + 1 }} ? 'rotate-180' : ''"></i>
                </button>
                <div class="grid transition-all duration-500 ease-in-out" :class="active === {{ $index + 1 }} ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                    <div class="overflow-hidden min-h-0">
                        <div class="px-6 pb-6 text-gray-500 text-sm leading-relaxed">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <x-landing.wave />
</section>
