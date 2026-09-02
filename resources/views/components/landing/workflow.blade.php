<section class="py-24 bg-slate-50 relative overflow-hidden" id="process">
    <div class="absolute -top-24 left-10 w-72 h-72 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-10 w-72 h-72 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                <i data-lucide="git-branch" class="w-4 h-4"></i> {{ __('ui.process.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.process.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.process.subtitle') }}</p>
        </div>

        <div class="relative">
            <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-px bg-linear-to-b from-primary/20 via-primary to-primary/20 transform -translate-x-1/2"></div>
            <div class="lg:hidden absolute left-1/2 top-0 bottom-0 w-px bg-linear-to-b from-primary/20 via-primary to-primary/20 transform -translate-x-1/2"></div>

            @foreach(company('riksa_uji_process') as $index => $step)
            <div class="relative flex flex-col lg:flex-row items-center mb-16 lg:mb-16" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                @if($index % 2 === 0)
                <div class="hidden lg:block lg:w-1/2 lg:pr-16 lg:text-right order-2 lg:order-1">
                    <h3 class="text-2xl font-bold text-secondary mb-3">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ $step['description'] }}</p>
                </div>
                @else
                <div class="lg:w-1/2 lg:pr-16 lg:text-right order-2 lg:order-1">
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center gap-3 text-accent justify-end">
                            <span class="text-sm font-semibold">{{ $step['title'] }}</span>
                            <i data-lucide="{{ $step['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <p class="text-gray-500 leading-relaxed mt-3 lg:hidden">{{ $step['description'] }}</p>
                    </div>
                </div>
                @endif

                <div class="relative z-10 flex items-center justify-center w-16 h-16 {{ $index % 2 === 0 ? 'bg-primary' : 'bg-accent' }} rounded-2xl text-white shadow-lg my-4 lg:my-0 order-1 lg:order-2 shrink-0">
                    <span class="text-xl font-bold">{{ $step['step'] }}</span>
                </div>

                @if($index % 2 === 0)
                <div class="lg:w-1/2 lg:pl-16 order-3">
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center gap-3 text-primary">
                            <i data-lucide="{{ $step['icon'] }}" class="w-6 h-6"></i>
                            <span class="text-sm font-semibold">{{ $step['title'] }}</span>
                        </div>
                        <p class="text-gray-500 leading-relaxed mt-3 lg:hidden">{{ $step['description'] }}</p>
                    </div>
                </div>
                @else
                <div class="hidden lg:block lg:w-1/2 lg:pl-16 order-3">
                    <h3 class="text-2xl font-bold text-secondary mb-3">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ $step['description'] }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
