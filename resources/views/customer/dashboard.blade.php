@extends('layouts.customer')

@section('title', 'Dashboard - NTU')

@section('content')
<div class="space-y-8">
    {{-- Welcome --}}
    <div class="bg-gradient-to-r from-primary/10 via-primary/5 to-transparent rounded-2xl p-6 border border-primary/10">
        <div class="flex items-center gap-4">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-primary/30 shadow-sm">
            @else
                <div class="w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center text-xl font-bold text-primary shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-secondary">Selamat datang, {{ Auth::user()->name }}</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola permohonan riksa uji dan profil Anda dari sini.</p>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-primary/5 rounded-bl-[40px]"></div>
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-3">
                    <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                </div>
                <p class="text-2xl font-bold text-secondary">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Total Permohonan</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-warning/5 rounded-bl-[40px]"></div>
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-warning/10 flex items-center justify-center mb-3">
                    <i data-lucide="clock" class="w-5 h-5 text-warning"></i>
                </div>
                <p class="text-2xl font-bold text-secondary">{{ $stats['pending'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Menunggu Review</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/5 rounded-bl-[40px]"></div>
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center mb-3">
                    <i data-lucide="loader" class="w-5 h-5 text-blue-500"></i>
                </div>
                <p class="text-2xl font-bold text-secondary">{{ $stats['processing'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Sedang Diproses</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-500/5 rounded-bl-[40px]"></div>
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
                </div>
                <p class="text-2xl font-bold text-secondary">{{ $stats['completed'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Selesai</p>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div>
        <h2 class="text-lg font-bold text-secondary mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('customer.requests.create') }}"
               class="group block bg-gradient-to-br from-primary to-primary/80 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                    <i data-lucide="file-plus" class="w-5 h-5 text-white"></i>
                </div>
                <h3 class="font-semibold text-white group-hover:text-white/90 transition-colors">Ajukan Riksa Uji</h3>
                <p class="text-xs text-white/70 mt-1">Buat permohonan baru</p>
            </a>

            <a href="{{ route('customer.requests') }}"
               class="group block bg-gradient-to-br from-accent to-accent/80 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                    <i data-lucide="clock" class="w-5 h-5 text-white"></i>
                </div>
                <h3 class="font-semibold text-white group-hover:text-white/90 transition-colors">Riwayat Permohonan</h3>
                <p class="text-xs text-white/70 mt-1">Lihat semua permohonan</p>
            </a>

            <a href="{{ route('customer.profile') }}"
               class="group block bg-gradient-to-br from-secondary to-secondary/80 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                    <i data-lucide="user" class="w-5 h-5 text-white"></i>
                </div>
                <h3 class="font-semibold text-white group-hover:text-white/90 transition-colors">Profil Saya</h3>
                <p class="text-xs text-white/70 mt-1">Perbarui data diri</p>
            </a>

            <a href="{{ route('customer.company') }}"
               class="group block bg-gradient-to-br from-warning to-warning/80 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center mb-4">
                    <i data-lucide="building-2" class="w-5 h-5 text-white"></i>
                </div>
                <h3 class="font-semibold text-white group-hover:text-white/90 transition-colors">Profil Perusahaan</h3>
                <p class="text-xs text-white/70 mt-1">Kelola data perusahaan</p>
            </a>
        </div>
    </div>

    {{-- Recent Activity --}}
    @if($recentRequests->count())
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-secondary">Permohonan Terbaru</h2>
            <a href="{{ route('customer.requests') }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4 inline-block"></i>
            </a>
        </div>
        <div class="space-y-3">
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
            @foreach($recentRequests as $req)
                <a href="{{ route('customer.requests.show', $req) }}"
                   class="block bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.08)] border border-gray-100 p-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-secondary truncate">{{ $req->request_number }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $req->company->name ?? '-' }} &middot; {{ $req->objects->count() }} objek</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-500' }}">
                                {{ $statusLabels[$req->status] ?? $req->status }}
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300 group-hover:text-primary group-hover:translate-x-1 transition-all"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
