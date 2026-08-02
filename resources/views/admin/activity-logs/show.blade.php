@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Activity Log Detail" subtitle="Recorded {{ $activityLog->created_at?->format('d M Y, H:i:s') }}" back="{{ panel_route('activity-logs.index') }}">
    </x-admin.page-header>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-secondary">{{ ucfirst($activityLog->action) }}</h3>
                            <p class="text-sm text-gray-500">{{ $activityLog->description ?: 'No description' }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">User</p>
                                <p class="text-sm text-secondary">{{ $activityLog->user?->name ?? 'System' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">IP Address</p>
                                <p class="text-sm text-secondary font-mono">{{ $activityLog->ip_address ?: '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Browser</p>
                                <p class="text-sm text-secondary">{{ $activityLog->browser }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Platform</p>
                                <p class="text-sm text-secondary">{{ $activityLog->platform }}</p>
                            </div>
                            @if ($activityLog->subject_type)
                                <div>
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Subject</p>
                                    <p class="text-sm text-secondary">{{ class_basename($activityLog->subject_type) }} #{{ $activityLog->subject_id }}</p>
                                </div>
                            @endif
                        </div>

                        @if ($activityLog->properties)
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Properties</p>
                                <pre class="bg-gray-50 border border-gray-100 rounded-lg p-4 text-xs text-gray-600 overflow-x-auto">{{ json_encode($activityLog->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        @endif
                    </div>
                </div>
            </x-card>
        </div>

        <div>
            <x-card>
                <div class="p-6">
                    <h3 class="text-sm font-bold text-secondary mb-4">User Agent</h3>
                    <p class="text-xs text-gray-500 break-words leading-relaxed">{{ $activityLog->user_agent ?: '—' }}</p>
                </div>
            </x-card>
        </div>
    </div>
@endsection
