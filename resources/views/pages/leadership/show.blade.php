@extends('layouts.landing')

@section('title', $person['name'])

@section('content')
    <x-landing.page-hero
        :title="$person['name']"
        :subtitle="$person['position']"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-1" data-aos="fade-right">
                    <div class="sticky top-28">
                        <div class="glass-card rounded-3xl overflow-hidden text-center">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset($person['image']) }}" alt="{{ $person['name'] }}" loading="lazy" class="w-full h-full object-cover object-top">
                                <div class="absolute inset-0 bg-gradient-to-t from-white via-white/20 to-transparent"></div>
                            </div>
                            <div class="p-6">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full mb-3">
                                    {{ $person['position'] }}
                                </div>
                                <h1 class="text-xl font-bold text-secondary mb-4">{{ $person['name'] }}</h1>
                                <p class="text-sm text-gray-400 mb-4">{{ $person['academic'] }}</p>
                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="text-sm font-bold text-secondary mb-3">Keahlian</h4>
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @foreach($person['expertise'] as $exp)
                                        <span class="px-2 py-1 bg-white/70 text-gray-500 text-xs rounded-lg">{{ $exp }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('leadership') }}" class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-primary bg-primary/5 rounded-xl hover:bg-primary/10 transition-all">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Semua Profil
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-12" data-aos="fade-left">
                    <div>
                        <h2 class="text-2xl font-bold text-secondary mb-4">Profil</h2>
                        <p class="text-gray-600 leading-relaxed text-md text-justify">{{ $person['bio'] }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
