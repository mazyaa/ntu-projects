<section class="py-24 bg-white relative overflow-hidden" id="tim-teknis">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                <i data-lucide="users" class="w-4 h-4"></i> {{ __('ui.technical_team.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.technical_team.h2') }}</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.technical_team.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            @php
                $team = [
                    [
                        'name' => 'Akhmad Munandar Prio Sudarma, S.T.',
                        'position' => 'Engineering Manager',
                        'expertise' => 'Ahli K3 Pesawat Angkat dan Angkut (PAPA)',
                        'experience' => '8+ tahun sebagai Technical Expert di berbagai PJK3',
                        'image' => 'images/team/006akhmad.webp',
                        'color' => 'primary',
                        'details' => ['Inspeksi & Pengujian K3', 'Lifting Equipment', 'Boiler & Pressure Vessel', 'Resource Person K3 Kemnaker'],
                    ],
                    [
                        'name' => 'Syarif Hidayat, Ph.D.',
                        'position' => 'Direktur Utama',
                        'expertise' => 'Insinyur Kimia & Riset Terapan',
                        'experience' => '10+ tahun pengalaman industri',
                        'image' => 'images/team/001syarif.webp',
                        'color' => 'accent',
                        'details' => ['Teknologi Proses Lingkungan', 'Manajemen Proyek', 'Pengolahan Air Limbah', 'Formulasi Kimia'],
                    ],
                    [
                        'name' => 'Fitriyah, M.Si.',
                        'position' => 'Komisaris',
                        'expertise' => 'Tata Kelola & Pengembangan Kelembagaan',
                        'experience' => 'Pengawasan strategis perusahaan',
                        'image' => 'images/team/005bupipit.webp',
                        'color' => 'success',
                        'details' => ['Good Corporate Governance', 'Pengelolaan Risiko', 'Kepatuhan Regulasi', 'Pengembangan Organisasi'],
                    ],
                ];
            @endphp

            @foreach($team as $index => $person)
            <div class="glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative aspect-2/3 overflow-hidden">
                    <img src="{{ asset($person['image']) }}" alt="{{ $person['name'] }}" loading="lazy" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-linear-to-t from-white via-white/20 to-transparent"></div>
                </div>
                <div class="p-6 text-center">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-{{ $person['color'] }}/10 text-{{ $person['color'] }} text-xs font-bold rounded-full mb-3">
                        {{ $person['position'] }}
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-2">{{ $person['name'] }}</h3>
                    <p class="text-sm text-gray-500 font-medium mb-2">{{ $person['expertise'] }}</p>
                    <p class="text-xs text-gray-400 mb-4">{{ $person['experience'] }}</p>
                    <div class="flex flex-wrap justify-center gap-1.5">
                        @foreach($person['details'] as $detail)
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-medium rounded-full">{{ $detail }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
