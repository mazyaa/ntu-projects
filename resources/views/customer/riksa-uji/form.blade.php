@extends('layouts.customer')

@section('title', 'Ajukan Riksa Uji - NTU')

@push('styles')
<style>
    .timeline-connector {
        transition: background-color 0.4s ease;
    }
    .timeline-dot {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .timeline-dot.active {
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 0 0 rgba(7, 54, 170, 0.3); }
        50% { box-shadow: 0 0 0 8px rgba(7, 54, 170, 0); }
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Step Indicator --}}
    <div class="mb-8">
        {{-- Desktop: Horizontal Stepper --}}
        <div class="hidden md:flex items-start justify-between">
            @for($i = 1; $i <= $totalSteps; $i++)
                @php
                    $isActive = $i === $step;
                    $isCompleted = $i < $step;
                    $isClickable = $isCompleted;
                @endphp
                <div class="flex flex-col items-center flex-1 {{ $i < $totalSteps ? 'relative' : '' }}">
                    {{-- Circle --}}
                    <div class="relative z-10">
                        @if($isClickable)
                            <a href="{{ route('customer.requests.goToStep', $i) }}"
                               class="group timeline-dot w-12 h-12 rounded-full flex items-center justify-center text-sm font-bold bg-[#0B9918] text-white hover:bg-[#098015] hover:scale-110 hover:shadow-lg hover:shadow-[#0B9918]/30 transition-all duration-300"
                               title="Kembali ke: {{ $stepTitles[$i] }}">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </a>
                        @elseif($isActive)
                            <div class="timeline-dot active w-12 h-12 rounded-full flex items-center justify-center text-sm font-bold bg-[#0736AA] text-white ring-4 ring-[#0736AA]/20">
                                {{ $i }}
                            </div>
                        @else
                            <div class="timeline-dot w-12 h-12 rounded-full flex items-center justify-center text-sm font-bold bg-gray-100 text-gray-400 border-2 border-gray-200">
                                {{ $i }}
                            </div>
                        @endif
                    </div>

                    {{-- Label --}}
                    <span class="text-[11px] mt-2 text-center font-medium max-w-[90px] leading-tight
                        {{ $isActive ? 'text-[#0736AA] font-bold' : '' }}
                        {{ $isCompleted ? 'text-[#0B9918]' : '' }}
                        {{ !$isActive && !$isCompleted ? 'text-gray-400' : '' }}">
                        {{ $stepTitles[$i] }}
                    </span>

                    {{-- Connector Line --}}
                    @if($i < $totalSteps)
                        <div class="absolute top-6 left-[calc(50%+28px)] right-[calc(-50%+28px)] h-1.5 rounded-full timeline-connector
                            {{ $isCompleted ? 'bg-[#0B9918]' : 'bg-gray-200' }}">
                        </div>
                    @endif
                </div>
            @endfor
        </div>

        {{-- Mobile: Vertical Stepper --}}
        <div class="md:hidden">
            <div class="space-y-0">
                @for($i = 1; $i <= $totalSteps; $i++)
                    @php
                        $isActive = $i === $step;
                        $isCompleted = $i < $step;
                        $isClickable = $isCompleted;
                    @endphp
                    <div class="flex items-stretch {{ $i < $totalSteps ? '' : '' }}">
                        {{-- Left: Circle + Line --}}
                        <div class="flex flex-col items-center w-10 mr-3">
                            @if($isClickable)
                                <a href="{{ route('customer.requests.goToStep', $i) }}"
                                   class="timeline-dot w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold bg-[#0B9918] text-white hover:bg-[#098015] transition-all duration-300 shrink-0"
                                   title="Kembali ke: {{ $stepTitles[$i] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </a>
                            @elseif($isActive)
                                <div class="timeline-dot active w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold bg-[#0736AA] text-white ring-2 ring-[#0736AA]/20 shrink-0">
                                    {{ $i }}
                                </div>
                            @else
                                <div class="timeline-dot w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold bg-gray-100 text-gray-400 border-2 border-gray-200 shrink-0">
                                    {{ $i }}
                                </div>
                            @endif
                            @if($i < $totalSteps)
                                <div class="w-0.5 flex-1 min-h-[24px] timeline-connector
                                    {{ $isCompleted ? 'bg-[#0B9918]' : 'bg-gray-200' }}">
                                </div>
                            @endif
                        </div>

                        {{-- Right: Label --}}
                        <div class="flex items-center py-1.5 {{ $i < $totalSteps ? 'pb-4' : '' }} min-h-[48px]">
                            <span class="text-sm font-medium
                                {{ $isActive ? 'text-[#0736AA] font-bold' : '' }}
                                {{ $isCompleted ? 'text-[#0B9918]' : '' }}
                                {{ !$isActive && !$isCompleted ? 'text-gray-400' : '' }}">
                                {{ $stepTitles[$i] }}
                            </span>
                            @if($isActive)
                                <span class="ml-2 text-[10px] font-semibold text-white bg-[#0736AA] px-2 py-0.5 rounded-full">Aktif</span>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- Step Content + Submit Form --}}
    <form action="{{ route('customer.requests.storeStep', $step) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-6 md:p-8 transform transition-all duration-300">
            @include('customer.riksa-uji.step-' . $step)
        </div>

        {{-- Navigation Buttons --}}
        @if($step < 8)
            <div class="flex items-center justify-between mt-6">
                @if($step > 1)
                    <button type="submit" formaction="{{ route('customer.requests.previous', $step) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition-all text-sm font-medium shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali
                    </button>
                @else
                    <div></div>
                @endif

                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#0736AA] text-white hover:bg-[#06205E] transition-all text-sm font-semibold shadow-lg shadow-[#0736AA]/25 hover:shadow-[#0736AA]/40 hover:-translate-y-0.5">
                    @if($step === 7)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Ajukan Permohonan
                    @else
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    @endif
                </button>
            </div>
        @endif
    </form>

</div>
@endsection
