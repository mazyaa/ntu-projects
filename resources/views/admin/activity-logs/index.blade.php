@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Activity Logs" subtitle="Audit trail of administrator actions.">
    </x-admin.page-header>
@endsection

@section('content')
    <x-card>
        <div class="p-6">
            <!-- Filters -->
            <form method="GET" action="{{ panel_route('activity-logs.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search description, IP, or user agent..."
                           class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700 placeholder-gray-400">
                </div>
                <div>
                    <select name="action" class="py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                        <option value="">All actions</option>
                        @foreach (['login', 'logout'] as $action)
                            <option value="{{ $action }}" @selected(request('action') === $action)>{{ ucfirst($action) }}</option>
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
                            <th class="py-3 px-4">User</th>
                            <th class="py-3 px-4">Action</th>
                            <th class="py-3 px-4">Description</th>
                            <th class="py-3 px-4">IP Address</th>
                            <th class="py-3 px-4">Browser</th>
                            <th class="py-3 px-4">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="py-3 px-4 text-sm text-secondary">{{ $log->user?->name ?? 'System' }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600 max-w-xs truncate">{{ $log->description ?: '—' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500 font-mono">{{ $log->ip_address ?: '—' }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $log->browser }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $log->created_at?->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sm text-gray-400">No activity log entries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $logs->links() }}
            </div>
        </div>
    </x-card>
@endsection
