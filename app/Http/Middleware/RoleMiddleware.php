<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Memeriksa apakah user yang sedang login memiliki role yang sesuai.
     * Penggunaan di route: middleware('role:admin') atau middleware('role:admin,anggota')
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Daftar role yang diizinkan (dipisah koma)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Jika user belum login, redirect ke login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Jika role user tidak termasuk dalam daftar yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
