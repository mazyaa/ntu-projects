<section class="py-8 bg-slate-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(__('ui.trust_strip.items') as $index => $item)
            <div class="flex items-center gap-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="w-10 h-10 shrink-0 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                    <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-secondary leading-tight">{{ $item['title'] }}</h3>
                    <p class="text-xs text-gray-500 leading-snug hidden sm:block">{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
