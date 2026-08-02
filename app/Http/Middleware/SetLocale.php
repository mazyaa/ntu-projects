<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Locales supported on the public site (kept in sync with lang/).
     */
    public const SUPPORTED = ['id', 'en'];

    /**
     * Resolve the locale from the matched route group (en.* routes live
     * under the /en prefix) and apply it to the current request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->routeIs('en.*') ? 'en' : 'id';

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = 'id';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
