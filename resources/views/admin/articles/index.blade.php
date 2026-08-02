@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Artikel" subtitle="Kelola artikel, proses review, dan publikasi konten.">
        @can('articles.create')
        <x-slot name="actions">
            <a href="{{ panel_route('articles.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Buat Artikel
            </a>
        </x-slot>
        @endcan
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <!-- Filters -->
            <form method="GET" action="{{ panel_route('articles.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <div>
                    <select name="status" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="">Semua status</option>
                        @foreach(\App\Enums\ArticleStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    Filter
                </button>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="py-3 px-4">Judul</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Penulis</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Views</th>
                            <th class="py-3 px-4">Dibuat</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($articles as $article)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="py-3 px-4">
                                    <p class="text-sm font-semibold text-secondary">{{ $article->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 font-mono">{{ $article->slug }}</p>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                        {{ $article->category?->name ?? '—' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">{{ $article->author?->name ?? '—' }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->status->color() }}">
                                        {{ $article->status->label() }}
                                    </span>
                                    @if($article->status === \App\Enums\ArticleStatus::Scheduled && $article->scheduled_at)
                                        <p class="text-[11px] text-gray-400 mt-1">
                                            {{ $article->scheduled_at->format('d M Y H:i') }}
                                        </p>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                        <i data-lucide="eye" class="w-3.5 h-3.5 text-gray-400"></i>
                                        {{ number_format($article->views_count) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $article->created_at?->format('d M Y') }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end gap-1">
                                        @can('articles.edit', $article)
                                        <a href="{{ panel_route('articles.edit', $article) }}" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        @endcan

                                        @if(in_array($article->status, [\App\Enums\ArticleStatus::Draft, \App\Enums\ArticleStatus::Scheduled]) && auth()->user()->hasPermissionTo('articles.publish'))
                                            <form method="POST" action="{{ panel_route('articles.publish', $article) }}" onsubmit="return confirm('Publikasikan artikel ini?')">
                                                @csrf
                                                <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-success hover:bg-gray-50 transition-colors" title="Publikasikan">
                                                    <i data-lucide="send" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($article->status === \App\Enums\ArticleStatus::Published && auth()->user()->hasPermissionTo('articles.archive'))
                                            <form method="POST" action="{{ panel_route('articles.archive', $article) }}" onsubmit="return confirm('Arsipkan artikel ini?')">
                                                @csrf
                                                <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-warning hover:bg-gray-50 transition-colors" title="Arsipkan">
                                                    <i data-lucide="archive" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($article->status === \App\Enums\ArticleStatus::Archived)
                                            <form method="POST" action="{{ panel_route('articles.restore', $article) }}" onsubmit="return confirm('Pulihkan artikel ke Draft?')">
                                                @csrf
                                                <button type="submit" class="p-2 rounded-lg text-gray-500 hover:text-primary hover:bg-gray-50 transition-colors" title="Pulihkan">
                                                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @can('articles.delete', $article)
                                        <form method="POST" action="{{ panel_route('articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini permanen?')">
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
                                <td colspan="7" class="py-8 text-center text-sm text-gray-400">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        </div>
    </x-card>
@endsection
