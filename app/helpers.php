<?php

use Illuminate\Support\Facades\Auth;

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
