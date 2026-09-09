@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Permohonan Riksa Uji" subtitle="Daftar permohonan inspeksi yang masuk." />
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <form method="GET" action="{{ panel_route('inspection-requests.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor permohonan, nama pemohon, atau email..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <div>
                    <select name="status" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    Filter
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="py-3 px-4">No. Permohonan</th>
                            <th class="py-3 px-4">Pemohon</th>
                            <th class="py-3 px-4">Perusahaan</th>
                            <th class="py-3 px-4 text-center">Jumlah Objek</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($requests as $req)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="py-3 px-4">
                                    <span class="text-sm font-semibold text-primary">{{ $req->request_number }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm font-medium text-secondary">{{ $req->applicant_name }}</div>
                                    <div class="text-xs text-gray-400">{{ $req->applicant_email }}</div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">{{ $req->company->name ?? '-' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-600 text-center">{{ $req->objects->count() }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $req->submitted_at?->format('d M Y') ?? '-' }}</td>
                                <td class="py-3 px-4">
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
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-500' }}">
                                        {{ $statuses[$req->status] ?? $req->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end gap-1">
                                        @can('riksa_uji.view')
                                            <a href="{{ panel_route('inspection-requests.show', $req) }}" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Lihat">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-sm text-gray-400">
                                    <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                                    Belum ada permohonan riksa uji.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $requests->links() }}
            </div>
        </div>
    </x-card>
@endsection
