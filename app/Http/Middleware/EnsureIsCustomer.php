<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsCustomer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        if (auth()->user()->role !== 'customer') {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Hanya akun customer yang dapat melakukan booking.',
                ], 403);
            }

            return redirect()->route('dashboard')->with('error', 'Hanya akun customer yang dapat melakukan booking foto.');
        }

        return $next($request);
    }
}

