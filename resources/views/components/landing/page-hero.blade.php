@props(['title', 'subtitle' => null, 'breadcrumb' => null])

<section class="relative pt-32 pb-16 bg-linear-to-br from-secondary via-secondary to-primary overflow-hidden">
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0F_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0F_1px,transparent_1px)] bg-size-[24px_24px]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8" aria-label="{{ __('ui.page_hero.breadcrumb') }}">
            @if($breadcrumb)
                @foreach($breadcrumb as $crumb)
                    @if(!empty($crumb['url']))
                        <a href="{{ $crumb['url'] }}" class="hover:text-white transition-colors">{{ $crumb['label'] }}</a>
                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    @else
                        <span class="text-white/80">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            @else
                <a href="{{ lroute('home') }}" class="hover:text-white transition-colors">{{ __('ui.page_hero.home') }}</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-white/80">{{ $title ?? '' }}</span>
            @endif
        </nav>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">{{ $title ?? '' }}</h1>

        @if(!empty($subtitle))
            <p class="text-lg text-white/60 max-w-2xl">{{ $subtitle }}</p>
        @endif
    </div>
</section>
