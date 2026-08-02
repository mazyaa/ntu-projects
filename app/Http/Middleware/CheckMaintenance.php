<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Block visitors while maintenance mode is enabled.
     *
     * Applies to every request in the web group, including logged-in panel
     * users, so the public site shows the maintenance page for everyone.
     * Authentication routes and the health endpoint stay reachable so admins
     * can log in and disable the mode from the panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('auth/*', 'auth', 'logout', 'confirm-password', 'password', 'up', 'admin/*', 'admin', 'editor/*', 'editor')) {
            return $next($request);
        }

        $enabled = Setting::query()
            ->where('group', 'maintenance')
            ->where('key', 'enabled')
            ->value('value');

        if (filter_var($enabled, FILTER_VALIDATE_BOOLEAN)) {
            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}
