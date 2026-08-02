@extends('layouts.landing')

@section('title', __('ui.page_titles.about'))

@section('content')
    <x-landing.page-hero
        :title="__('ui.about_page.hero_title')"
        :subtitle="__('ui.about_page.hero_subtitle')"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <div data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                        <i data-lucide="book-open" class="w-4 h-4"></i> {{ __('ui.about_page.badge_story') }}
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6 leading-tight">{{ company('name') }}</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>{{ company('overview.intro') }}</p>
                        <p>{{ company('overview.founded') }}</p>
                        <p>{{ company('overview.evolution') }}</p>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                        <i data-lucide="scroll" class="w-4 h-4"></i> {{ __('ui.about_page.badge_legal') }}
                    </div>
                    <div class="glass-card rounded-3xl overflow-hidden">
                        @foreach(company('legal') as $item)
                        <div class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-1">{{ $item['label'] }}</p>
                                <p class="text-sm text-gray-500">{{ $item['value'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="compass" class="w-4 h-4"></i> {{ __('ui.about_page.badge_vm') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.about_page.section_vm_h2') }}</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="glass-card rounded-3xl p-8 mb-8" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                            <i data-lucide="target" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">{{ __('ui.about_page.vision_label') }}</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg">{{ company('vision') }}</p>
                </div>

                <div class="glass-card rounded-3xl p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-accent/10 rounded-2xl flex items-center justify-center text-accent">
                            <i data-lucide="rocket" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">{{ __('ui.about_page.mission_label') }}</h3>
                    </div>
                    <ol class="space-y-4">
                        @foreach(company('mission') as $index => $mission)
                        <li class="flex gap-4">
                            <span class="shrink-0 w-8 h-8 bg-accent/10 rounded-full flex items-center justify-center text-accent text-sm font-bold">{{ $index + 1 }}</span>
                            <p class="text-gray-600 leading-relaxed pt-1">{{ $mission }}</p>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <x-landing.values />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-6">
                    <i data-lucide="lightbulb" class="w-4 h-4"></i> {{ __('ui.about_page.badge_philosophy') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.about_page.section_philosophy_h2') }}</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">{{ __('ui.about_page.section_philosophy_sub') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center p-8 glass-card rounded-3xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mx-auto mb-6">
                        <i data-lucide="search" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-3">{{ __('ui.about_page.approach_evidence_title') }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ __('ui.about_page.approach_evidence_text') }}</p>
                </div>

                <div class="text-center p-8 glass-card rounded-3xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-accent/10 rounded-2xl flex items-center justify-center text-accent mx-auto mb-6">
                        <i data-lucide="cog" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-3">{{ __('ui.about_page.approach_engineering_title') }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ __('ui.about_page.approach_engineering_text') }}</p>
                </div>

                <div class="text-center p-8 glass-card rounded-3xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-success/10 rounded-2xl flex items-center justify-center text-success mx-auto mb-6">
                        <i data-lucide="leaf" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-3">{{ __('ui.about_page.approach_sustainability_title') }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ __('ui.about_page.approach_sustainability_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-6">
                    <i data-lucide="route" class="w-4 h-4"></i> {{ __('ui.about_page.badge_journey') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">{{ __('ui.about_page.section_journey_h2') }}</h2>
            </div>

            <div class="max-w-3xl mx-auto">
                @foreach(company('timeline') as $index => $milestone)
                <div class="relative flex gap-8 pb-12 last:pb-0" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="shrink-0 flex flex-col items-center">
                        <div class="w-12 h-12 bg-{{ $index === count(company('timeline')) - 0 ? 'success' : 'primary' }} rounded-xl flex items-center justify-center text-white shadow-lg">
                            <i data-lucide="{{ $milestone['icon'] }}" class="w-5 h-5"></i>
                        </div>
                        @if($index < count(company('timeline')) - 1)
                        <div class="w-px h-full bg-primary/20 mt-2"></div>
                        @endif
                    </div>
                    <div class="pb-8">
                        <span class="text-sm font-bold text-primary">{{ $milestone['year'] }}</span>
                        <h3 class="text-lg font-bold text-secondary mt-1 mb-2">{{ $milestone['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $milestone['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
