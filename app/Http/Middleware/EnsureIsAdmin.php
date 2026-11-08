<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Role akun bukan admin.');
        }

        return $next($request);
    }
}