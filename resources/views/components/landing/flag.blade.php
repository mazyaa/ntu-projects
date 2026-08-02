@props(['code' => 'id', 'class' => ''])

@php
    $styles = 'h-4 w-5 shrink-0 rounded-[2px] ring-1 ring-black/5 ' . $class;
@endphp

@if ($code === 'en')
    @php static $ukUid = 0; $ukUid++; $clip = 'uk-clip-' . $ukUid; $diag = 'uk-diag-' . $ukUid; @endphp
    <svg class="{{ $styles }}" viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
        <clipPath id="{{ $clip }}"><path d="M0,0 v30 h60 v-30 z"/></clipPath>
        <clipPath id="{{ $diag }}"><path d="M30,15 h30 v15 z v15 h-30 z h-30 v-15 z v-15 h30 z"/></clipPath>
        <g clip-path="url(#{{ $clip }})">
            <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
            <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
            <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#{{ $diag }})" stroke="#C8102E" stroke-width="4"/>
            <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
            <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
        </g>
    </svg>
@else
    <svg class="{{ $styles }}" viewBox="0 0 640 480" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
        <path fill="#CE1126" d="M0 0h640v240H0z"/>
        <path fill="#fff" d="M0 240h640v240H0z"/>
    </svg>
@endif
