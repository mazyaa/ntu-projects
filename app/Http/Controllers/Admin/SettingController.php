<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get();

        $grouped = $settings->groupBy('group');

        return view('admin.settings.index', compact('grouped'));
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $field = "{$setting->group}.{$setting->key}";

            if (! $request->has($field)) {
                continue;
            }

            $setting->value = $this->encodeValue($request->input($field), $setting->type);
            $setting->save();
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    private function encodeValue($value, string $type): string
    {
        return match ($type) {
            'boolean' => $value ? '1' : '0',
            'integer' => (string) ((int) $value),
            'json' => json_encode($value, JSON_UNESCAPED_UNICODE),
            default => (string) $value,
        };
    }
}
