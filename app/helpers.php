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
        $prefix = Auth::user()?->hasRole('Editor') ? 'editor' : 'admin';

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
