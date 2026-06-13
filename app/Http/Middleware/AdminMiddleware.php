<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/');
        }

        $user = auth()->user();

        if (!($user->isAdmin() || $user->isPetinggi())) {
            return redirect('/member/form');
        }

        return $next($request);
    }
}