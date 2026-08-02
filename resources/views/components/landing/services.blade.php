<section class="py-24 bg-white relative overflow-hidden" id="services">
    <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="briefcase" class="w-4 h-4"></i> Pilar Layanan
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Enam Pilar Strategis</h2>
                <p class="text-gray-500">Solusi terintegrasi yang mencakup riset terapan, rekayasa, teknologi lingkungan, pengujian & inspeksi, teknologi informasi, serta jasa penunjang.</p>
            </div>
            <a href="{{ route('services.index') }}" class="inline-flex items-center text-primary font-bold hover:text-primary/80 transition-colors group">
                Lihat Semua Layanan
                <i data-lucide="arrow-right" class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $delays = [100, 200, 300, 400, 500, 600];
            @endphp
            @foreach(\App\Models\Service::active()->orderBy('sort_order')->get() as $index => $service)
            @php $brandColors = ['primary' => '#0736AA', 'secondary' => '#06205E', 'accent' => '#0B9918', 'success' => '#22C55E']; @endphp
            <div class="glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-300 group flex flex-col" data-aos="fade-up" data-aos-delay="{{ $delays[$index] }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->short_title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                    <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white border border-white/30" style="background-color: {{ $brandColors[$service->color] }}">
                        <i data-lucide="{{ $service->icon }}" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $service->title }}</h3>
                    <p class="text-gray-500 text-sm mb-6 flex-1 leading-relaxed">{{ $service->tagline }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-sm font-bold text-secondary flex items-center gap-1 group-hover:text-primary transition-colors">
                        Pelajari Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
