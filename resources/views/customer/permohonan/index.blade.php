@extends('layouts.customer')

@section('title', 'Riwayat Permohonan - NTU')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-secondary">Riwayat Permohonan</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar seluruh permohonan riksa uji yang telah diajukan.</p>
        </div>
        <a href="{{ route('customer.requests.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all shadow-sm hover:shadow-md">
            <i data-lucide="plus" class="w-4 h-4"></i> Ajukan Baru
        </a>
    </div>

    {{-- Request List --}}
    @php
        $statusLabels = [
            'new' => 'Baru',
            'reviewing' => 'Ditinjau',
            'contacted' => 'Dihubungi',
            'quotation_sent' => 'Penawaran Dikirim',
            'approved' => 'Disetujui',
            'scheduled' => 'Dijadwalkan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
        $statusColors = [
            'new' => 'bg-blue-100 text-blue-700',
            'reviewing' => 'bg-yellow-100 text-yellow-700',
            'contacted' => 'bg-purple-100 text-purple-700',
            'quotation_sent' => 'bg-indigo-100 text-indigo-700',
            'approved' => 'bg-green-100 text-green-700',
            'scheduled' => 'bg-teal-100 text-teal-700',
            'completed' => 'bg-emerald-500 text-white',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
    @endphp

    @forelse($requests as $req)
        <a href="{{ route('customer.requests.show', $req) }}"
           class="block bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-5 sm:p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 group">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                {{-- Left: Request Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-sm font-bold text-primary">{{ $req->request_number }}</span>
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ $statusLabels[$req->status] ?? $req->status }}
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="building-2" class="w-3.5 h-3.5 text-gray-400"></i>
                            {{ $req->company->name ?? '-' }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="package" class="w-3.5 h-3.5 text-gray-400"></i>
                            {{ $req->objects->count() }} objek
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400"></i>
                            {{ $req->submitted_at?->format('d M Y') ?? '-' }}
                        </span>
                    </div>
                </div>

                {{-- Right: Arrow --}}
                <div class="shrink-0">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-300 group-hover:text-primary group-hover:translate-x-1 transition-all"></i>
                </div>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-12 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
            </div>
            <h3 class="text-lg font-semibold text-secondary mb-1">Belum Ada Permohonan</h3>
            <p class="text-sm text-gray-500 mb-6">Anda belum mengajukan permohonan riksa uji.</p>
            <a href="{{ route('customer.requests.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary/90 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i> Ajukan Sekarang
            </a>
        </div>
    @endforelse

    {{-- Pagination --}}
    @if($requests->hasPages())
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @endif
</div>
@endsection
