<section class="py-12 bg-white border-y border-gray-100 overflow-hidden" id="trusted">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-8">
        <p class="text-center text-sm font-semibold text-gray-400 uppercase tracking-widest" data-aos="fade-up">{{ __('ui.trusted_by.label') }}</p>
    </div>

    <!-- Swiper Marquee -->
    <div class="swiper trusted-swiper w-full" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper items-center">
            <!-- Logos -->
            @for ($i = 1; $i <= 8; $i++)
            <div class="swiper-slide flex justify-center opacity-60 hover:opacity-100 transition-opacity duration-300 grayscale hover:grayscale-0">
                <div class="h-12 w-32 glass-card rounded-xl flex items-center justify-center text-gray-400 font-bold text-sm">
                    LOGO {{ $i }}
                </div>
            </div>
            @endfor
            <!-- Duplicates for smooth infinite loop -->
            @for ($i = 1; $i <= 8; $i++)
            <div class="swiper-slide flex justify-center opacity-60 hover:opacity-100 transition-opacity duration-300 grayscale hover:grayscale-0">
                <div class="h-12 w-32 glass-card rounded-xl flex items-center justify-center text-gray-400 font-bold text-sm">
                    LOGO {{ $i }}
                </div>
            </div>
            @endfor
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.trusted-swiper', {
                loop: true,
                speed: 3000,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                },
                slidesPerView: 3,
                spaceBetween: 30,
                breakpoints: {
                    640: { slidesPerView: 4, spaceBetween: 40 },
                    768: { slidesPerView: 5, spaceBetween: 50 },
                    1024: { slidesPerView: 6, spaceBetween: 60 },
                },
                allowTouchMove: false,
            });
        });
    </script>
    
    <style>
        /* Smooth continuous marquee effect for swiper */
        .trusted-swiper .swiper-wrapper {
            transition-timing-function: linear !important;
        }
    </style>
</section>
