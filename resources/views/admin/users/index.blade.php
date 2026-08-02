@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Pengguna" subtitle="Kelola akun pengguna dan peran (role) pada sistem.">
        @can('users.create')
        <x-slot name="actions">
            <a href="{{ panel_route('users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Pengguna
            </a>
        </x-slot>
        @endcan
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <form method="GET" action="{{ panel_route('users.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    Filter
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="py-3 px-4">Nama</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Role</th>
                            <th class="py-3 px-4">Bergabung</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-secondary">
                                                {{ $user->name }}
                                                @if($user->getKey() === auth()->id())
                                                    <span class="text-xs text-gray-400 font-normal">(Anda)</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    @foreach ($user->roles as $role)
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $role->name === 'Super Admin' ? 'bg-primary/10 text-primary' : ($role->name === 'Admin' ? 'bg-warning/10 text-warning' : 'bg-gray-100 text-gray-600') }}">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $user->created_at?->format('d M Y') }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end gap-1">
                                        @can('users.edit')
                                        <a href="{{ panel_route('users.edit', $user) }}" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        @endcan
                                        @can('users.delete')
                                        @if($user->getKey() !== auth()->id())
                                        <form method="POST" action="{{ panel_route('users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-danger hover:bg-red-50 transition-colors" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-gray-400">Belum ada pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </x-card>
@endsection
