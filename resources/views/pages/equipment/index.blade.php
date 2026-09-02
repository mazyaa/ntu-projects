@extends('layouts.landing')

@section('title', __('ui.page_titles.equipment'))

@section('content')
    <x-landing.page-hero
        :title="__('ui.equipment_page.hero_title')"
        :subtitle="__('ui.equipment_page.hero_subtitle')"
    />

    <x-landing.equipment-showcase />

    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-4">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Peralatan Pendukung
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Peralatan Lainnya</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Selain peralatan di atas, NTU juga mendukung penggunaan berbagai peralatan inspeksi dan pengujian lainnya sesuai kebutuhan pekerjaan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary shrink-0 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-secondary group-hover:text-primary transition-colors">Kain Majun</h3>
                            <p class="text-sm text-gray-500">Peralatan pendukung untuk pembersihan dan inspeksi</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent shrink-0 group-hover:bg-accent group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-secondary group-hover:text-primary transition-colors">Peralatan Kalibrasi</h3>
                            <p class="text-sm text-gray-500">Peralatan yang dikalibrasi untuk menjamin akurasi pengukuran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
