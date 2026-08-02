<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    /**
     * Restrict admin routes to authenticated users with an admin role.
     * Non-administrative users are logged out and redirected home.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'));
        }

        if (! Auth::user()->hasAnyRole(['Super Admin', 'Admin', 'Editor'])) {
            Auth::logout();

            return redirect()->route('home');
        }

        return $next($request);
    }
}
