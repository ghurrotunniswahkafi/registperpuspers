<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilamentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return $next($request);
        }

        // Check if user can access Filament
        if (!auth()->user()->canAccessFilament()) {
            return redirect('/member')->with('error', 'Anda tidak memiliki akses ke admin panel');
        }

        return $next($request);
    }
}
