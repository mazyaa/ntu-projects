@extends('layouts.landing')

@section('title', __('ui.page_titles.services'))

@section('content')
    <x-landing.page-hero
        :title="__('ui.services_page.hero_title')"
        :subtitle="__('ui.services_page.hero_subtitle')"
    />

    <section class="py-24 bg-white relative overflow-hidden cv-auto" x-data="{ activeTab: 'riksa_uji' }">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Tabs -->
            <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up">
                <button @click="activeTab = 'riksa_uji'" :class="activeTab === 'riksa_uji' ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-slate-100 text-gray-600 hover:bg-slate-200'" class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        {{ __('ui.services_page.tabs.riksa_uji') }}
                        <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs">{{ __('ui.services_page.riksa_uji_badge') }}</span>
                    </span>
                </button>
                <button @click="activeTab = 'konsultasi'" :class="activeTab === 'konsultasi' ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-slate-100 text-gray-600 hover:bg-slate-200'" class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <i data-lucide="message-square" class="w-4 h-4"></i>
                        {{ __('ui.services_page.tabs.konsultasi') }}
                    </span>
                </button>
                <button @click="activeTab = 'perizinan'" :class="activeTab === 'perizinan' ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-slate-100 text-gray-600 hover:bg-slate-200'" class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <i data-lucide="file-check" class="w-4 h-4"></i>
                        {{ __('ui.services_page.tabs.perizinan') }}
                    </span>
                </button>
            </div>

            <!-- Tab Content: Riksa Uji -->
            <div x-show="activeTab === 'riksa_uji'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($riksaUji as $index => $service)
                    <div class="bg-slate-50 rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                        <!-- 16:9 Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($service->image)
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" width="800" height="450" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-primary/5 flex items-center justify-center">
                                    <i data-lucide="shield-check" class="w-12 h-12 text-primary/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white bg-primary/90 border border-white/30">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-base font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $service->title }}</h3>
                            <p class="text-sm text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ $service->short_description ?? $service->description }}</p>
                            <a href="{{ lroute('contact') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all duration-300 shadow-md shadow-primary/20 group/btn">
                                <i data-lucide="clipboard-list" class="w-4 h-4 mr-2"></i>
                                {{ __('ui.services_page.btn_daftar') }}
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab Content: Konsultasi -->
            <div x-show="activeTab === 'konsultasi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($konsultasi as $index => $service)
                    <div class="bg-slate-50 rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                        <!-- 16:9 Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($service->image)
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" width="800" height="450" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-accent/5 flex items-center justify-center">
                                    <i data-lucide="message-square" class="w-12 h-12 text-accent/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white bg-accent/90 border border-white/30">
                                <i data-lucide="message-square" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-base font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $service->title }}</h3>
                            <p class="text-sm text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ $service->short_description ?? $service->description }}</p>
                            <a href="{{ lroute('contact') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-accent rounded-xl hover:bg-accent/90 transition-all duration-300 shadow-md shadow-accent/20 group/btn">
                                <i data-lucide="message-square" class="w-4 h-4 mr-2"></i>
                                {{ __('ui.services_page.btn_konsultasi') }}
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab Content: Perizinan -->
            <div x-show="activeTab === 'perizinan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($perizinan as $index => $service)
                    <div class="bg-slate-50 rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                        <!-- 16:9 Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($service->image)
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" width="800" height="450" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-success/5 flex items-center justify-center">
                                    <i data-lucide="file-check" class="w-12 h-12 text-success/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white bg-success/90 border border-white/30">
                                <i data-lucide="file-check" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-base font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $service->title }}</h3>
                            <p class="text-sm text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ $service->short_description ?? $service->description }}</p>
                            <a href="{{ lroute('contact') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-success rounded-xl hover:bg-success/90 transition-all duration-300 shadow-md shadow-success/20 group/btn">
                                <i data-lucide="message-square" class="w-4 h-4 mr-2"></i>
                                {{ __('ui.services_page.btn_konsultasi') }}
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
