<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Middleware untuk memeriksa peran pengguna sebelum mengakses suatu route.
     * Hanya mengizinkan akses jika peran sesuai.
     *
     * @package App\Http\Middleware
     */
    /**
     * Menangani request yang masuk dan memeriksa peran pengguna.
     *
     * @param  Request $request Request yang masuk
     * @param  \Closure $next Fungsi berikutnya
     * @param  string $role Nama peran yang diizinkan
     * @return Response Redirect atau response berikutnya
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role->name != $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
