<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- 1. Kita panggil kamus resmi Auth di sini

class RoleMiddleware
{
    /**
     * Memeriksa apakah user memiliki role yang diizinkan.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 2. Kita ganti auth()->check() menjadi Auth::check()
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 3. Kita ganti auth()->user() menjadi Auth::user()
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses Ditolak: Halaman ini khusus untuk Pegawai dan Administrator.');
        }

        return $next($request);
    }
}