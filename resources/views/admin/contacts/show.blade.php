@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Detail Pesan" subtitle="Pesan dari {{ $contact->name }} ({{ $contact->email }})." back="{{ panel_route('contacts.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <x-card class="lg:col-span-2">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $contact->status->color() }}">
                        {{ $contact->status->label() }}
                    </span>
                    <span class="text-sm text-gray-400">{{ $contact->created_at?->format('d M Y H:i') }}</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama</p>
                        <p class="text-sm font-medium text-secondary">{{ $contact->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</p>
                        <a href="mailto:{{ $contact->email }}" class="text-sm font-medium text-primary hover:underline">{{ $contact->email }}</a>
                    </div>
                    @if($contact->phone)
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                        <p class="text-sm font-medium text-secondary">{{ $contact->phone }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Subjek</p>
                        <p class="text-sm font-medium text-secondary">{{ $contact->subject ?: '—' }}</p>
                    </div>
                </div>

                <h3 class="text-base font-bold text-secondary mb-3">Pesan</h3>
                <div class="p-5 bg-gray-50 rounded-lg text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">
                    {{ $contact->message }}
                </div>
            </div>
        </x-card>

        <div class="space-y-6">
            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4">Ubah Status</h3>
                    @can('contacts.manage')
                    <form method="POST" action="{{ panel_route('contacts.status', $contact) }}" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                            @foreach(\App\Enums\ContactStatus::cases() as $status)
                                <option value="{{ $status->value }}" @selected($contact->status === $status)>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                            Perbarui Status
                        </button>
                    </form>
                    @else
                        <p class="text-sm text-gray-400">Anda tidak memiliki izin untuk mengubah status pesan.</p>
                    @endcan
                </div>
            </x-card>

            <x-card>
                <div class="p-6">
                    <h3 class="text-base font-bold text-secondary mb-4">Aksi</h3>
                    <div class="space-y-3">
                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?: 'Pesan Anda' }}"
                           class="flex items-center justify-center gap-2 w-full px-5 py-2.5 text-sm font-medium text-white bg-success rounded-lg hover:bg-success/90 transition-colors">
                            <i data-lucide="mail" class="w-4 h-4"></i> Balas via Email
                        </a>
                        @can('contacts.manage')
                        <form method="POST" action="{{ panel_route('contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus pesan ini permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center justify-center gap-2 w-full px-5 py-2.5 text-sm font-medium text-danger bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Pesan
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
