<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return response()->json(['message' => 'Login terlebih dahulu.'], 401); // Belum login
        }

        // 2. Cek apakah user memiliki role yang diperbolehkan
        if (!in_array(auth()->user()->role, $roles)) {
            return response()->json(['message' => 'Tidak memiliki akses.'], 403); // Role tidak sesuai
        }

        return $next($request); // Lolos, lanjut ke controller
    }
}
