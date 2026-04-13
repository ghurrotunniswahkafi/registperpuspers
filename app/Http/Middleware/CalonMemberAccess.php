<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalonMemberAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Alow non-authenticated users untuk access halaman ini (mereka akan di-redirect ke login)
        if (!auth()->check()) {
            return $next($request);
        }

        // Hanya calon_member bisa akses /member
        if (!auth()->user()->isCalon()) {
            return redirect('/admin')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
