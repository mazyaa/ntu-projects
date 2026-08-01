<section class="py-24 bg-white relative overflow-hidden" id="riset">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="flask-conical" class="w-4 h-4"></i> Riset & Kajian
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Riset & Tim Peneliti</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Setiap kajian dan proyek riset kami dipimpin oleh peneliti doktoral dan praktisi berpengalaman yang berdedikasi pada solusi berbasis bukti bagi pemerintah, industri, dan masyarakat.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            @php
                $delays = [100, 200, 300];
            @endphp
            @foreach(config('company-research.personnel') as $index => $person)
            <a href="{{ route('research') }}" class="group block glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $delays[$index] }}">
                <div class="relative aspect-2/3 overflow-hidden">
                    <img src="{{ asset($person['image']) }}" alt="{{ $person['name'] }}" loading="lazy" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-linear-to-t from-white via-white/20 to-transparent"></div>
                </div>
                <div class="p-6 text-center">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-{{ $person['color'] }}/10 text-{{ $person['color'] }} text-xs font-bold rounded-full mb-3">
                        {{ $person['role'] }}
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-2">{{ $person['name'] }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed line-clamp-3 mb-4">{{ $person['summary'] }}</p>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-100 rounded-full text-xs font-semibold text-gray-500 mb-4">
                        <i data-lucide="folder-kanban" class="w-3.5 h-3.5 text-primary"></i>
                        {{ count($person['projects']) }} Proyek Riset
                    </div>
                    <div class="inline-flex items-center gap-1 text-sm font-bold text-primary transition-all duration-300 group-hover:gap-2">
                        Lihat Rekam Jejak <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
