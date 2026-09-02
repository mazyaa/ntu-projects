<section class="py-24 bg-white relative overflow-hidden cv-auto" id="equipment">
    <div class="absolute -top-24 left-10 w-72 h-72 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-10 w-72 h-72 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="wrench" class="w-4 h-4"></i> {{ __('ui.equipment.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.equipment.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.equipment.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $equipment = [
                    ['name' => 'Load Cell', 'purpose' => 'Pengukuran beban dan gaya', 'icon' => 'scale'],
                    ['name' => 'Dye Penetrant Test (DPT)', 'purpose' => 'Deteksi retakan permukaan', 'icon' => 'droplets'],
                    ['name' => 'Magnetic Particle Inspection', 'purpose' => 'Deteksi cacat permukaan pada material feromagnetik', 'icon' => 'magnet'],
                    ['name' => 'Wire Rope Tester', 'purpose' => 'Pengujian kawat baja tali', 'icon' => 'link'],
                    ['name' => 'Insulation Tester', 'purpose' => 'Pengujian isolasi listrik', 'icon' => 'zap'],
                    ['name' => 'Multimeter', 'purpose' => 'Pengukuran listrik parameter', 'icon' => 'activity'],
                    ['name' => 'Laser Meter', 'purpose' => 'Pengukuran jarak presisi', 'icon' => 'ruler'],
                    ['name' => 'Calibrated Tools', 'purpose' => 'Peralatan terkalibrasi untuk pengujian', 'icon' => 'check-circle'],
                ];
            @endphp

            @foreach($equipment as $index => $item)
            <div class="bg-slate-50 p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm border border-gray-100 mb-5 group-hover:bg-primary group-hover:text-white group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <i data-lucide="{{ $item['icon'] }}" class="w-7 h-7"></i>
                </div>
                <h3 class="text-sm font-bold text-secondary mb-2 group-hover:text-primary transition-colors">{{ $item['name'] }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $item['purpose'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ lroute('contact') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all duration-300 shadow-lg shadow-primary/20 group">
                {{ __('ui.services.learn_more') }}
                <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>
