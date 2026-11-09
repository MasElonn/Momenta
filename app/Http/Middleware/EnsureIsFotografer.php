<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsFotografer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'fotografer' || auth()->user()->status_akun !== 'active') {
            abort(403, 'Akses khusus fotografer yang telah diverifikasi.');
        }

        return $next($request);
    }
}
