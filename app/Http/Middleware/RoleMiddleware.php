<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek role user sesuai parameter
        if (Auth::user()->role !== $role) {
            // Redirect ke dashboard sesuai role
            return Auth::user()->role === 'admin' 
                ? redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.')
                : redirect('/user/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}