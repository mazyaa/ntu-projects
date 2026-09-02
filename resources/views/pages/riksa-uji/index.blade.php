@extends('layouts.landing')

@section('title', __('ui.riksa_uji_page.hero_title') . ' — ' . company('name'))

@section('content')
    <x-landing.page-hero :title="__('ui.riksa_uji_page.hero_title')"
        :subtitle="__('ui.riksa_uji_page.hero_subtitle')" />

    <!-- Penjelasan Detail Riksa Uji -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                        <i data-lucide="shield-check" class="w-4 h-4"></i> {{ __('ui.riksa_uji_page.definition.badge') }}
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">{{ __('ui.riksa_uji_page.definition.h2') }}</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        {{ __('ui.riksa_uji_page.definition.p1') }}
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        {{ __('ui.riksa_uji_page.definition.p2') }}
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach(__('ui.riksa_uji_page.definition.checks') as $index => $check)
                        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <div class="w-10 h-10 {{ $index % 2 === 0 ? 'bg-primary/10 text-primary' : ($index % 3 === 0 ? 'bg-success/10 text-success' : 'bg-accent/10 text-accent') }} rounded-lg flex items-center justify-center shrink-0">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-medium text-secondary">{{ $check }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div data-aos="fade-left" x-data="{ active: 1 }">
                    <div class="space-y-3">
                        @foreach (__('ui.riksa_uji_page.definition.faq_items') as $index => $item)
                            <div class="glass-card rounded-2xl overflow-hidden transition-all duration-300 {{ $index + 1 === 1 ? 'ring-2 ring-primary/20' : '' }}">
                                <button @click="active = active === {{ $index + 1 }} ? null : {{ $index + 1 }}"
                                    class="w-full flex items-center gap-4 p-5 text-left font-bold text-secondary hover:text-primary transition-colors"
                                    :class="active === {{ $index + 1 }} ? 'text-primary' : ''">
                                    <div class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center transition-colors duration-300"
                                        :class="active === {{ $index + 1 }} ? 'bg-primary text-white' : 'bg-primary/10 text-primary'">
                                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                                    </div>
                                    <span class="flex-1 text-sm lg:text-base">{{ $item['title'] }}</span>
                                    <i data-lucide="chevron-down" class="w-5 h-5 shrink-0 transition-transform duration-300"
                                        :class="active === {{ $index + 1 }} ? 'rotate-180' : ''"></i>
                                </button>
                                <div class="grid transition-all duration-500 ease-in-out"
                                    :class="active === {{ $index + 1 }} ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                                    <div class="overflow-hidden min-h-0">
                                        <div class="px-5 pb-5 pl-19 text-gray-500 text-sm leading-relaxed">
                                            {{ $item['text'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Objek Pesawat Angkat & Angkut - Cards with Images -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute -top-24 right-0 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-4">
                    <i data-lucide="crane" class="w-4 h-4"></i> {{ __('ui.pesawat_angkat.badge') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.pesawat_angkat.h2') }}</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.pesawat_angkat.subtitle') }}</p>
            </div>

            @php
                $categories = __('ui.pesawat_angkat.categories');
                $icons = [
                    'arrow-down-circle',
                    'crane',
                    'rotate-3d',
                    'users',
                    'tractor',
                    'train-front',
                    'circle-user-round',
                    'truck',
                    'bot',
                    'link',
                ];
                $images = [
                    'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=800&h=450&fit=crop',
                    'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&h=450&fit=crop',
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $name => $description)
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                        <!-- 16:9 Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $images[$loop->index] }}" alt="{{ $name }}" width="800" height="450" loading="lazy" decoding="async"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl shadow-lg flex items-center justify-center text-white bg-primary/90 border border-white/30">
                                <i data-lucide="{{ $icons[$loop->index] ?? 'wrench' }}" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $name }}</h3>
                            <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">{{ $description }}</p>
                            <a href="{{ lroute('contact') }}" class="inline-flex items-center gap-1 text-sm font-bold text-primary hover:text-primary/80 transition-colors">
                                {{ __('ui.riksa_uji_page.btn_daftar') }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Equipment Section - Cards with Images -->
    <section class="py-24 bg-white relative overflow-hidden">
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
                @foreach ($equipment as $index => $item)
                    <div class="bg-slate-50 rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 hover:-translate-y-2 transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <!-- 16:9 Image -->
                        <div class="relative h-40 overflow-hidden">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="800" height="450" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full bg-primary/5 flex items-center justify-center">
                                    <i data-lucide="wrench" class="w-10 h-10 text-primary/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/15 to-transparent"></div>
                            <div class="absolute top-3 left-3 w-10 h-10 rounded-xl shadow-lg flex items-center justify-center text-white bg-primary/90 border border-white/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <i data-lucide="wrench" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-5">
                            <h3 class="text-sm font-bold text-secondary mb-2 group-hover:text-primary transition-colors leading-snug">{{ $item->name }}</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $item->description }}</p>
                            @if($item->capacity)
                                <p class="text-xs text-primary font-semibold mt-2">{{ $item->capacity }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Peralatan Pendukung -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto" data-aos="fade-up">
                @foreach (__('ui.equipment.support_items') as $index => $item)
                <div class="bg-white p-6 rounded-3xl border border-gray-100 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 {{ $index === 0 ? 'bg-primary/10 text-primary' : 'bg-accent/10 text-accent' }} rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-secondary group-hover:text-primary transition-colors">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $item['purpose'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-landing.workflow />

    <x-landing.cta />
@endsection
