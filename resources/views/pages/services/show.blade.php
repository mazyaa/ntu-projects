@extends('layouts.landing')

@section('title', $service->title)

@section('content')
    <x-landing.page-hero
        :title="$service->title"
        :subtitle="$service->tagline"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 bg-{{ $service->color }}/10 rounded-2xl flex items-center justify-center text-{{ $service->color }}">
                            <i data-lucide="{{ $service->icon }}" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-secondary">{{ $service->title }}</h1>
                            <span class="text-sm text-gray-400">{{ $service->short_title }}</span>
                        </div>
                    </div>

                    <p class="text-gray-600 leading-relaxed text-lg mb-8">{{ $service->description }}</p>

                    <h3 class="text-xl font-bold text-secondary mb-6">Lingkup Layanan</h3>
                    <div class="space-y-4">
                        @foreach($service->service_items ?? [] as $item)
                        <div class="flex items-start gap-4 p-4 glass-card rounded-xl">
                            <div class="w-8 h-8 bg-{{ $service->color }}/10 rounded-lg flex items-center justify-center text-{{ $service->color }} shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-1" data-aos="fade-left">
                    <div class="sticky top-28">
                        <div class="glass-card rounded-3xl p-6">
                            <h3 class="text-lg font-bold text-secondary mb-4">Pilar Lainnya</h3>
                            <div class="space-y-2">
                                @foreach($services as $other)
                                @if($other->slug !== $service->slug)
                                <a href="{{ route('services.show', $other->slug) }}" class="flex items-center gap-3 p-3 bg-white/70 rounded-xl border border-white/60 hover:border-primary/20 hover:shadow-sm transition-all text-sm text-gray-600 hover:text-primary">
                                    <i data-lucide="{{ $other->icon }}" class="w-4 h-4 shrink-0"></i>
                                    <span class="font-medium">{{ $other->short_title }}</span>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 glass-card rounded-3xl p-6 border border-primary/20">
                            <h4 class="font-bold text-secondary mb-2">Butuh Konsultasi?</h4>
                            <p class="text-sm text-gray-500 mb-4">Diskusikan kebutuhan layanan Anda dengan tim ahli kami.</p>
                            <a href="mailto:{{ config('company.contact.email') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary/90 transition-all w-full justify-center">
                                Hubungi Kami <i data-lucide="mail" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
