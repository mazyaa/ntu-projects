@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Detail Permohonan" subtitle="{{ $request->request_number }}" back="{{ panel_route('inspection-requests.index') }}">
        <x-slot name="actions">
            @php
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
            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$request->status] ?? 'bg-gray-100 text-gray-500' }}">
                {{ $statuses[$request->status] ?? $request->status }}
            </span>
        </x-slot>
    </x-admin.page-header>
@endsection

@section('content')
    {{-- Status Change --}}
    @can('riksa_uji.edit')
    <x-card class="mb-6">
        <div class="p-6">
            <h3 class="text-sm font-semibold text-secondary mb-3">Ubah Status</h3>
            <form method="POST" action="{{ panel_route('inspection-requests.status', ['inspectionRequest' => $request->id]) }}" class="flex flex-col sm:flex-row gap-3" x-data="{ status: '{{ $request->status }}' }">
                @csrf
                @method('PATCH')
                <select name="status" x-model="status" class="flex-1 py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" @selected($request->status === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    Perbarui Status
                </button>
            </form>
        </div>
    </x-card>
    @endcan

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- PEMOHON --}}
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5 text-primary"></i> Pemohon
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->applicant_name }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Jabatan</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->applicant_position ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                            <a href="tel:{{ $request->applicant_phone }}" class="text-sm font-medium text-primary hover:underline">{{ $request->applicant_phone ?: '-' }}</a>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                            <a href="mailto:{{ $request->applicant_email }}" class="text-sm font-medium text-primary hover:underline">{{ $request->applicant_email }}</a>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- PERUSAHAAN --}}
            @if($request->company)
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="building-2" class="w-5 h-5 text-primary"></i> Perusahaan
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Perusahaan</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->company->name }}</p>
                        </div>
                        <div class="sm:col-span-2 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->company->address ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Provinsi / Kota</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->company->city ? $request->company->city . ', ' . $request->company->province : '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                            <a href="tel:{{ $request->company->phone }}" class="text-sm font-medium text-primary hover:underline">{{ $request->company->phone ?: '-' }}</a>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                            <a href="mailto:{{ $request->company->email }}" class="text-sm font-medium text-primary hover:underline">{{ $request->company->email ?: '-' }}</a>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">NIB</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->company->nib ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">NPWP</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->company->npwp ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </x-card>
            @endif

            {{-- OBJEK --}}
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="package" class="w-5 h-5 text-primary"></i> Objek Riksa Uji
                    </h3>
                    @if($request->objects->count())
                        <div class="space-y-4">
                            @foreach($request->objects as $index => $obj)
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
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
                                            <p class="text-xs text-gray-400">Tahun Pembuatan</p>
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
            </x-card>

            {{-- RIKSA UJI SEBELUMNYA --}}
            @if($request->has_previous_inspection)
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="history" class="w-5 h-5 text-primary"></i> Riksa Uji Sebelumnya
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">No. Sertifikat</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->previous_certificate_number ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Inspeksi</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->previous_inspection_date?->format('d M Y') ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Kadaluarsa</p>
                            <p class="text-sm font-medium text-secondary {{ $request->certificate_expiry_date && $request->certificate_expiry_date->isPast() ? 'text-red-600' : '' }}">
                                {{ $request->certificate_expiry_date?->format('d M Y') ?: '-' }}
                                @if($request->certificate_expiry_date && $request->certificate_expiry_date->isPast())
                                    <span class="text-xs font-normal">(Kadaluarsa)</span>
                                @endif
                            </p>
                        </div>
                        <div class="sm:col-span-3 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">PJK3 Sebelumnya</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->previous_pjk3 ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </x-card>
            @endif
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">
            {{-- LOKASI --}}
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i> Lokasi Inspeksi
                    </h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->inspection_address ?: '-' }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Provinsi / Kota</p>
                            <p class="text-sm font-medium text-secondary">{{ $request->inspection_city ? $request->inspection_city . ', ' . $request->inspection_province : '-' }}</p>
                        </div>
                        @if($request->location_notes)
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Catatan Lokasi</p>
                            <p class="text-sm text-secondary whitespace-pre-wrap">{{ $request->location_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </x-card>

            {{-- DOKUMEN --}}
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-primary"></i> Dokumen
                    </h3>
                    @if($request->documents->count())
                        <div class="space-y-2">
                            @foreach($request->documents as $doc)
                                <a href="{{ $doc->url() }}" target="_blank" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="w-8 h-8 flex items-center justify-center bg-primary/10 text-primary rounded-lg shrink-0">
                                        <i data-lucide="file" class="w-4 h-4"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-secondary truncate group-hover:text-primary transition-colors">{{ $doc->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $doc->file_name }}</p>
                                    </div>
                                    <i data-lucide="download" class="w-4 h-4 text-gray-400 group-hover:text-primary transition-colors shrink-0"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-400 text-center py-4">Tidak ada dokumen yang dilampirkan.</p>
                    @endif
                </div>
            </x-card>

            {{-- CATATAN INTERNAL --}}
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4 flex items-center gap-2">
                        <i data-lucide="message-square" class="w-5 h-5 text-primary"></i> Catatan Internal
                    </h3>

                    <div class="space-y-3 mb-4 max-h-80 overflow-y-auto">
                        @forelse($request->notes->sortByDesc('created_at') as $note)
                            <div class="p-3 bg-gray-50 rounded-lg">
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

                    @can('riksa_uji.edit')
                    <form method="POST" action="{{ panel_route('inspection-requests.notes', ['inspectionRequest' => $request->id]) }}">
                        @csrf
                        <textarea name="note" rows="3" required placeholder="Tambah catatan internal..."
                                  class="w-full p-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400 resize-none mb-3"></textarea>
                        <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                            Tambah Catatan
                        </button>
                    </form>
                    @endcan
                </div>
            </x-card>
        </div>
    </div>
@endsection
