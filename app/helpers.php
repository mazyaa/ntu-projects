<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

if (! function_exists('panel_route')) {
    /**
     * Resolve a panel route name to the URL matching the
     * current user's role prefix (editor.* for Editors, admin.* otherwise).
     */
    function panel_route(string $name, $params = [], bool $absolute = true): string
    {
        $prefix = Auth::user()?->hasRole('editor') ? 'editor' : 'admin';

        return route($prefix.'.'.$name, $params, $absolute);
    }
}

if (! function_exists('lroute')) {
    /**
     * Resolve a public site route name to a locale-aware URL
     * (en.* routes for the English site, plain routes otherwise).
     */
    function lroute(string $name, $params = [], bool $absolute = true): string
    {
        if (app()->getLocale() === 'en') {
            $name = 'en.'.$name;
        }

        return route($name, $params, $absolute);
    }
}

if (! function_exists('company')) {
    /**
     * Resolve localized company content (lang/{locale}/company*.php).
     */
    function company(?string $key = null, string $group = 'company')
    {
        $path = $key === null ? $group : $group.'.'.$key;

        return Lang::get($path);
    }
}

if (! function_exists('storage_file_url')) {
    /**
     * Generate a public URL for a file stored on the public disk.
     *
     * Uses the STORAGE_URL env variable in production (Hostinger).
     * Falls back to Laravel's asset() helper for local development.
     */
    function storage_file_url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        $path = ltrim($path, '/');
        $base = rtrim(env('STORAGE_URL', asset('storage')), '/');

        return $base.'/'.$path;
    }
}
