<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerAuthenticated
{
    /**
     * Restrict customer routes to authenticated users.
     * Admin/editor users are redirected to the admin panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->guest(route('customer.login'));
        }

        if (Auth::user()->hasAnyRole(['super_admin', 'admin', 'editor'])) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
