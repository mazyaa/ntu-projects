@extends('layouts.landing')

@section('title', 'Kepemimpinan')

@section('content')
    <x-landing.page-hero
        :title="'Kepemimpinan & Tim Ahli'"
        :subtitle="'Tim profesional dengan latar belakang akademik doktoral dan pengalaman internasional.'"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            @php
                $director = $people[0];
                $delays = [100, 200, 300, 400, 500, 600];
            @endphp

            <!-- Row 1: Direksi -->
            <div class="border-b border-gray-100 pb-16 mb-16" data-aos="fade-up">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-4">
                        <i data-lucide="crown" class="w-4 h-4"></i> Direksi
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary">Direktur Utama</h2>
                </div>
                <div class="max-w-4xl mx-auto">
                    <a href="{{ route('leadership.show', $director['slug']) }}" class="group block glass-card rounded-3xl overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1">
                        <div class="lg:flex lg:items-stretch">
                            <div class="lg:w-2/5 relative overflow-hidden">
                                <img src="{{ asset($director['image']) }}" alt="{{ $director['name'] }}" loading="lazy" class="w-full h-80 lg:h-full object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-out">
                            </div>
                            <div class="lg:w-3/5 p-8 lg:p-12 flex flex-col justify-center">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full mb-4 w-fit">
                                    <i data-lucide="award" class="w-3.5 h-3.5"></i> {{ $director['position'] }}
                                </div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-secondary mb-3">{{ $director['name'] }}</h3>
                                <p class="text-gray-500 leading-relaxed mb-6">{{ $director['intro'] }}</p>
                                <div class="inline-flex items-center gap-2 text-sm font-bold text-primary transition-all duration-300 group-hover:gap-3">
                                    Lihat Profil Lengkap <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Row 2: Tim Riset & Penasihat -->
            <div class="border-b border-gray-100 pb-16 mb-16">
                <div class="text-center mb-10" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-4">
                        <i data-lucide="flask-conical" class="w-4 h-4"></i> Tim Riset & Penasihat
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary">Pimpinan Riset & Penasihat</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(array_slice($people, 1, 3) as $index => $person)
                        <x-landing.person-card :person="$person" :delay="$delays[$index]" />
                    @endforeach
                </div>
            </div>

            <!-- Row 3: Komisaris & Manajemen -->
            <div>
                <div class="text-center mb-10" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-secondary/10 text-secondary text-sm font-semibold mb-4">
                        <i data-lucide="building-2" class="w-4 h-4"></i> Komisaris & Manajemen
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary">Pengawas & Manajemen Teknis</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-3xl mx-auto">
                    @foreach(array_slice($people, 4) as $index => $person)
                        <x-landing.person-card :person="$person" :delay="$delays[$index + 3]" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
