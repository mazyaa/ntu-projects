<section class="pt-24 pb-44 bg-secondary relative overflow-x-clip" id="statistics">
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0F_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0F_1px,transparent_1px)] bg-size-[24px_24px]"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60%] h-full bg-linear-to-b from-primary/20 via-transparent to-transparent blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[40%] h-[50%] bg-accent/15 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-white text-sm font-semibold mb-6">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i> {{ __('ui.statistics.badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('ui.statistics.h2') }}</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">{{ __('ui.statistics.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-12">
            @php
                $delays = [100, 200, 300, 400, 500];
            @endphp
            @foreach(company('stats') as $index => $stat)
            <div class="stat-item text-center" data-aos="fade-up" data-aos-delay="{{ $delays[$index] }}">
                <div class="text-4xl md:text-5xl font-bold text-{{ $stat['color'] }} mb-2">
                    <span class="counter" data-target="{{ $stat['value'] }}">0</span><span class="text-{{ $stat['color'] }}">{{ $stat['suffix'] }}</span>
                </div>
                <div class="w-8 h-0.5 bg-{{ $stat['color'] }}/40 mx-auto mb-3"></div>
                <p class="text-gray-400 text-sm font-medium">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            if (!counters.length) return;
            const animateCounter = (el) => {
                const target = parseInt(el.dataset.target);
                const duration = 2500;
                const start = performance.now();
                const update = (currentTime) => {
                    const elapsed = currentTime - start;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(eased * target);
                    if (progress < 1) requestAnimationFrame(update);
                    else el.textContent = target;
                };
                requestAnimationFrame(update);
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(c => observer.observe(c));
        });
    </script>

    <x-landing.wave fill="#FFFFFF" />
</section>
