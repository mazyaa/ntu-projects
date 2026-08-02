<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectPanelByRole
{
    /**
     * Keep each role on its own panel prefix.
     * Editors are redirected from /admin/* to /editor/* and vice-versa.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $path = $request->path();

        $currentPrefix = (str_starts_with($path, 'editor/') || $path === 'editor')
            ? 'editor'
            : 'admin';

        $targetPrefix = Auth::user()->hasRole('Editor') ? 'editor' : 'admin';

        if ($currentPrefix !== $targetPrefix) {
            $newPath = preg_replace(
                '#^'.$currentPrefix.'(/.*)?$#',
                $targetPrefix.'$1',
                $path,
            );

            return redirect('/'.ltrim($newPath, '/'));
        }

        return $next($request);
    }
}
