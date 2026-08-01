

import Alpine from 'alpinejs';
import Lenis from 'lenis';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { createIcons, icons } from 'lucide';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { CountUp } from 'countup.js';
import Typed from 'typed.js';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import Swal from 'sweetalert2';

// Alpine JS Setup
window.Alpine = Alpine;
Alpine.start();

// Make libraries available globally
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
gsap.registerPlugin(ScrollTrigger);
window.Swiper = Swiper;
window.CountUp = CountUp;
window.Typed = Typed;
window.Swal = Swal;
window.Notyf = new Notyf({
    duration: 4000,
    position: { x: 'right', y: 'top' },
    ripple: true,
});

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide Icons
    createIcons({ icons });

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-cubic'
    });

    // Initialize Lenis (Smooth Scrolling)
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), 
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
    
    // Connect GSAP ScrollTrigger to Lenis
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
});
