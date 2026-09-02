<section class="py-24 bg-white relative overflow-hidden cv-auto">
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                <i data-lucide="crane" class="w-4 h-4"></i> {{ __('ui.pesawat_angkat.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.pesawat_angkat.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.pesawat_angkat.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $equipment = [
                    ['name' => 'Overhead Crane', 'desc' => 'Pengangkatan beban di area workshop dan gudang dengan kapasitas hingga ratusan ton.'],
                    ['name' => 'Mobile Crane', 'desc' => 'Crane bergerak untuk kebutuhan konstruksi dan pemindahan beban di lapangan.'],
                    ['name' => 'Tower Crane', 'desc' => 'Crane menara untuk proyek konstruksi gedung dan infrastruktur tinggi.'],
                    ['name' => 'Forklift', 'desc' => 'Alat angkut untuk pemindahan barang dan material di area logistik dan gudang.'],
                    ['name' => 'Reach Stacker', 'desc' => 'Alat pengangkut kontainer di pelabuhan dan area penyimpanan kontainer.'],
                    ['name' => 'Telehandler', 'desc' => 'Traktor telescopic untuk pengangkatan beban di ketinggian dan jarak tertentu.'],
                    ['name' => 'Scissor Lift', 'desc' => 'Platform angkat gunting untuk pekerjaan di ketinggian dengan stabilitas tinggi.'],
                    ['name' => 'Manlift', 'desc' => 'Boom lift untuk akses pekerjaan di ketinggian dengan jangkauan vertikal dan horizontal.'],
                ];
            @endphp

            @foreach($equipment as $index => $item)
            <div class="bg-slate-50 p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-secondary mb-2 group-hover:text-primary transition-colors">{{ $item['name'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ lroute('riksa_uji') }}" class="inline-flex items-center text-primary font-bold hover:text-primary/80 transition-colors group">
                {{ __('ui.riksa_uji_services.view_detail') }}
                <i data-lucide="arrow-right" class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>
