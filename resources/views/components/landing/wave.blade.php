@props([
    'fill' => '#0736AA',
    'flip' => false,
    'height' => 'h-[80px] md:h-[120px]',
])

<div {{ $attributes->merge(['class' => 'absolute inset-x-0 pointer-events-none leading-none z-10 ' . ($flip ? '-top-[2px] rotate-180' : '-bottom-[2px]')]) }} aria-hidden="true">
    <svg class="block w-full {{ $height }}" viewBox="0 0 1440 120" preserveAspectRatio="none">
        <path fill="{{ $fill }}" d="M0,64 C240,120 480,0 720,40 C960,80 1200,110 1440,60 L1440,240 L0,240 Z"></path>
    </svg>
</div>
