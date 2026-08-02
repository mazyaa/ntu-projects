@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Inbox Pesan" subtitle="Pesan dari form kontak publik.">
        <x-slot name="actions">
            <a href="{{ panel_route('contacts.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                <i data-lucide="inbox" class="w-4 h-4"></i> Semua ({{ $counts['total'] }})
            </a>
            <span class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium bg-danger/10 text-danger rounded-lg">
                <i data-lucide="mail" class="w-4 h-4"></i> Belum Dibaca ({{ $counts['unread'] }})
            </span>
        </x-slot>
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <form method="GET" action="{{ panel_route('contacts.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau pesan..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <div>
                    <select name="status" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="">Semua status</option>
                        @foreach(\App\Enums\ContactStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
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
                            <th class="py-3 px-4">Pengirim</th>
                            <th class="py-3 px-4">Subjek</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Diterima</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($contacts as $contact)
                            <tr class="hover:bg-gray-50/60 transition-colors {{ $contact->status === \App\Enums\ContactStatus::Unread ? 'bg-primary/[0.03]' : '' }}">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-secondary">{{ $contact->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $contact->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600 max-w-xs">
                                    <p class="truncate">{{ $contact->subject ?: '(tanpa subjek)' }}</p>
                                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ $contact->message }}</p>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contact->status->color() }}">
                                        {{ $contact->status->label() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $contact->created_at?->diffForHumans() }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ panel_route('contacts.show', $contact) }}" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Lihat">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        @can('contacts.manage')
                                        <form method="POST" action="{{ panel_route('contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-danger hover:bg-red-50 transition-colors" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-gray-400">Belum ada pesan kontak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $contacts->links() }}
            </div>
        </div>
    </x-card>
@endsection
