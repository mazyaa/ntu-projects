@extends('layouts.landing')

@section('title', __('ui.page_titles.contact'))

@section('content')
    <x-landing.page-hero
        :title="__('ui.contact_page.hero_title')"
        :subtitle="__('ui.contact_page.hero_subtitle')"
    />

    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
                <!-- Info -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-secondary mb-6">{{ __('ui.contact_page.info_h2') }}</h2>
                    <p class="text-gray-500 leading-relaxed mb-10">
                        {{ __('ui.contact_page.info_intro') }}
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-secondary mb-1">{{ __('ui.contact_page.address_label') }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ company('contact.address') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-accent/10 text-accent flex items-center justify-center shrink-0">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-secondary mb-1">{{ __('ui.contact_page.phone_label') }}</h3>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', company('contact.phone')) }}" class="text-sm text-gray-500 hover:text-primary transition-colors">{{ company('contact.phone') }}</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-warning/10 text-warning flex items-center justify-center shrink-0">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-secondary mb-1">{{ __('ui.contact_page.email_label') }}</h3>
                                <a href="mailto:{{ company('contact.email') }}" class="text-sm text-gray-500 hover:text-primary transition-colors">{{ company('contact.email') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="lg:col-span-3" data-aos="fade-left" data-aos-delay="100">
                    <div class="glass-card rounded-3xl p-8 lg:p-10">
                        <h2 class="text-2xl font-bold text-secondary mb-2">{{ __('ui.contact_page.form_h2') }}</h2>
                        <p class="text-gray-500 text-sm mb-8">{{ __('ui.contact_page.form_sub') }}</p>

                        @if($errors->any())
                            <div class="mb-6 p-4 rounded-2xl bg-danger/10 border border-danger/20 text-danger text-sm">
                                <p class="font-medium mb-2">{{ __('ui.contact_page.errors_header') }}</p>
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ lroute('contact.store') }}" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2" for="name">{{ __('ui.contact_page.name_label') }}</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                           class="w-full py-3 px-4 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 text-gray-700" placeholder="{{ __('ui.contact_page.name_placeholder') }}">
                                    @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2" for="email">{{ __('ui.contact_page.email_label') }}</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                           class="w-full py-3 px-4 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 text-gray-700" placeholder="{{ __('ui.contact_page.email_placeholder') }}">
                                    @error('email') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2" for="phone">{{ __('ui.contact_page.phone_label_optional') }}</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                           class="w-full py-3 px-4 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 text-gray-700" placeholder="+62...">
                                    @error('phone') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2" for="subject">{{ __('ui.contact_page.subject_label_optional') }}</label>
                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                           class="w-full py-3 px-4 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 text-gray-700" placeholder="{{ __('ui.contact_page.subject_placeholder') }}">
                                    @error('subject') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-secondary mb-2" for="message">{{ __('ui.contact_page.message_label') }}</label>
                                <textarea id="message" name="message" rows="6" required
                                          class="w-full py-3 px-4 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 text-gray-700" placeholder="{{ __('ui.contact_page.message_placeholder') }}">{{ old('message') }}</textarea>
                                @error('message') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all duration-300 hover:shadow-lg hover:shadow-primary/30 transform hover:-translate-y-0.5">
                                <i data-lucide="send" class="w-4 h-4"></i> {{ __('ui.contact_page.submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
