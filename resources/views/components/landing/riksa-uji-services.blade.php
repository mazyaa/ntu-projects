<section class="py-24 bg-slate-50 relative overflow-hidden cv-auto" id="riksa-uji-services">
    <div class="absolute -top-24 left-10 w-72 h-72 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-10 w-72 h-72 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="shield-check" class="w-4 h-4"></i> {{ __('ui.riksa_uji_services.badge') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.riksa_uji_services.h2') }}</h2>
                <p class="text-gray-500">{{ __('ui.riksa_uji_services.subtitle') }}</p>
            </div>
            <a href="{{ lroute('riksa_uji') }}" class="inline-flex items-center text-primary font-bold hover:text-primary/80 transition-colors group">
                {{ __('ui.riksa_uji_services.view_detail') }}
                <i data-lucide="arrow-right" class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $categories = __('ui.pesawat_angkat.categories');
                $delays = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
                $icons = ['cable', 'crane', 'rotate-3d', 'user', 'tractor', 'train-front', 'circle-user-round', 'truck', 'bot', 'link'];
            @endphp
            @foreach($categories as $name => $description)
            <div class="bg-white p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $delays[$loop->index] }}">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 shrink-0 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i data-lucide="{{ $icons[$loop->index] ?? 'wrench' }}" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-secondary mb-2 group-hover:text-primary transition-colors">{{ $name }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ lroute('riksa_uji') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all duration-300 shadow-lg shadow-primary/20 group">
                {{ __('ui.riksa_uji_services.view_detail') }}
                <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>
