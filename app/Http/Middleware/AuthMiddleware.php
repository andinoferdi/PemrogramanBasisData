<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Mengecek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
