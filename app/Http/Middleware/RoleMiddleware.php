<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Accepts roles as variadic parameters, e.g. roles:1 or roles:1,2
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        // Normalize roles to integers
        $allowed = array_map(function ($r) {
            return (int) trim($r);
        }, $roles);

        if (!in_array((int) $user->role, $allowed, true)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
