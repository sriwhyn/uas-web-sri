<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Tangani permintaan yang masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login dan memiliki 'role' 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') { // Mengubah 'level_pengguna' menjadi 'role'
            return $next($request);
        }

        // Jika tidak memenuhi syarat (tidak login atau bukan admin), tampilkan error 403
        abort(403, 'Akses dibatasi hanya untuk admin.');
    }
}
    