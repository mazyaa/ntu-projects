@extends('layouts.customer')

@section('title', 'Detail Permohonan ' . $request->request_number . ' - NTU')

@section('content')
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

<div class="space-y-6">
    {{-- Back + Header --}}
    <div>
        <a href="{{ route('customer.requests') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-primary transition-colors mb-4">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Riwayat
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-secondary">{{ $request->request_number }}</h1>
                <p class="text-sm text-gray-500 mt-1">Diajukan {{ $request->submitted_at?->format('d M Y H:i') ?? '-' }}</p>
            </div>
            <span class="inline-flex self-start px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-500' }}">
                {{ $statusLabels[$request->status] ?? $request->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- PEMOHON --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="user" class="w-5 h-5 text-primary"></i> Pemohon
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->applicant_name }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Jabatan</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->applicant_position ?: '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                        <a href="tel:{{ $request->applicant_phone }}" class="text-sm font-medium text-primary hover:underline">{{ $request->applicant_phone ?: '-' }}</a>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                        <a href="mailto:{{ $request->applicant_email }}" class="text-sm font-medium text-primary hover:underline">{{ $request->applicant_email }}</a>
                    </div>
                </div>
            </div>

            {{-- PERUSAHAAN --}}
            @if($request->company)
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="building-2" class="w-5 h-5 text-primary"></i> Perusahaan
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2 p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Perusahaan</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->company->name }}</p>
                    </div>
                    <div class="sm:col-span-2 p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->company->address ?: '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Kota / Provinsi</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->company->city ? $request->company->city . ', ' . $request->company->province : '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                        <a href="tel:{{ $request->company->phone }}" class="text-sm font-medium text-primary hover:underline">{{ $request->company->phone ?: '-' }}</a>
                    </div>
                </div>
            </div>
            @endif

            {{-- OBJEK --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="package" class="w-5 h-5 text-primary"></i> Objek Riksa Uji
                </h3>
                @if($request->objects->count())
                    <div class="space-y-4">
                        @foreach($request->objects as $index => $obj)
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="w-6 h-6 flex items-center justify-center bg-primary/10 text-primary rounded-full text-xs font-bold">{{ $index + 1 }}</span>
                                    <span class="text-sm font-semibold text-secondary">{{ $obj->object_name }}</span>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    <div>
                                        <p class="text-xs text-gray-400">Kategori</p>
                                        <p class="text-sm text-secondary">{{ $obj->category->name ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Tipe</p>
                                        <p class="text-sm text-secondary">{{ $obj->type->name ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Merek</p>
                                        <p class="text-sm text-secondary">{{ $obj->brand ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Model</p>
                                        <p class="text-sm text-secondary">{{ $obj->model ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">No. Seri</p>
                                        <p class="text-sm text-secondary">{{ $obj->serial_number ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Kapasitas</p>
                                        <p class="text-sm text-secondary">{{ $obj->capacity ? $obj->capacity . ' ' . ($obj->capacity_unit ?: '') : '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Tahun</p>
                                        <p class="text-sm text-secondary">{{ $obj->manufacture_year ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">No. Pabrik</p>
                                        <p class="text-sm text-secondary">{{ $obj->factory_number ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-400 text-center py-4">Tidak ada objek yang dilampirkan.</p>
                @endif
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">
            {{-- LOKASI --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i> Lokasi Inspeksi
                </h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->inspection_address ?: '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Kota / Provinsi</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->inspection_city ? $request->inspection_city . ', ' . $request->inspection_province : '-' }}</p>
                    </div>
                    @if($request->location_notes)
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Catatan Lokasi</p>
                        <p class="text-sm text-secondary whitespace-pre-wrap">{{ $request->location_notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- CATATAN --}}
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="message-square" class="w-5 h-5 text-primary"></i> Catatan
                </h3>
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @forelse($request->notes->sortByDesc('created_at') as $note)
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs font-semibold text-secondary">{{ $note->user->name ?? 'Admin' }}</span>
                                <span class="text-xs text-gray-400">{{ $note->created_at?->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600 whitespace-pre-wrap">{{ $note->note }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center py-4">Belum ada catatan.</p>
                    @endforelse
                </div>
            </div>

            {{-- RIKSA UJI SEBELUMNYA --}}
            @if($request->has_previous_inspection)
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-6">
                <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                    <i data-lucide="history" class="w-5 h-5 text-primary"></i> Riksa Uji Sebelumnya
                </h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">No. Sertifikat</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->previous_certificate_number ?: '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Inspeksi</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->previous_inspection_date?->format('d M Y') ?: '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">PJK3 Sebelumnya</p>
                        <p class="text-sm font-medium text-secondary">{{ $request->previous_pjk3 ?: '-' }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
