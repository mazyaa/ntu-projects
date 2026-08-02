@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Settings" subtitle="Manage system-wide configuration values.">
    </x-admin.page-header>
@endsection

@section('content')
    <form method="POST" action="{{ panel_route('settings.update') }}">
        @csrf
        @method('PATCH')

        <div class="space-y-6">
            @forelse ($grouped as $group => $settings)
                <x-card>
                    <div class="p-6">
                        <h3 class="text-base font-bold text-secondary mb-1">{{ ucfirst(str_replace('_', ' ', $group)) }}</h3>
                        <p class="text-sm text-gray-500 mb-6">Configuration for this group.</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach ($settings as $setting)
                                <div>
                                    <label class="block text-sm font-medium text-secondary mb-2" for="field-{{ $setting->id }}">
                                        {{ $setting->label ?: ucwords(str_replace('_', ' ', $setting->key)) }}
                                    </label>

                                    @if ($setting->description)
                                        <p class="text-xs text-gray-400 mb-2">{{ $setting->description }}</p>
                                    @endif

                                    @if ($setting->type === 'boolean')
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="hidden" name="{{ $setting->group }}[{{ $setting->key }}]" value="0">
                                            <input type="checkbox"
                                                   id="field-{{ $setting->id }}"
                                                   name="{{ $setting->group }}[{{ $setting->key }}]"
                                                   value="1"
                                                   @checked((bool) $setting->decodedValue())
                                                   class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                                            <span class="ml-2 text-sm text-gray-600">Enabled</span>
                                        </label>
                                    @elseif ($setting->type === 'textarea')
                                        <textarea id="field-{{ $setting->id }}"
                                                  name="{{ $setting->group }}[{{ $setting->key }}]"
                                                  rows="4"
                                                  class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">{{ old($setting->group.'.'.$setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="text"
                                               id="field-{{ $setting->id }}"
                                               name="{{ $setting->group }}[{{ $setting->key }}]"
                                               value="{{ old($setting->group.'.'.$setting->key, $setting->value) }}"
                                               class="w-full py-2 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-card>
            @empty
                <x-card>
                    <div class="p-12 text-center">
                        <i data-lucide="settings-2" class="w-10 h-10 text-gray-300 mx-auto mb-4"></i>
                        <p class="text-sm text-gray-400">No settings have been seeded yet.</p>
                    </div>
                </x-card>
            @endforelse
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                Save Settings
            </button>
        </div>
    </form>
@endsection
