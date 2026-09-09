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
     * Customers are logged out and redirected with a forbidden toast.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'));
        }

        if (! Auth::user()->hasAnyRole(['super_admin', 'admin', 'editor'])) {
            Auth::logout();

            $message = app()->getLocale() === 'en'
                ? 'You do not have access to this page.'
                : 'Anda tidak memiliki akses ke halaman ini.';

            session()->flash('toast', [
                'type' => 'error',
                'message' => $message,
            ]);

            return redirect()->route('login');
        }

        return $next($request);
    }
}
