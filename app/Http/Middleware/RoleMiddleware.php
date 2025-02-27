<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Si el usuario es admin, puede acceder a cualquier ruta
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Si el usuario tiene el rol correcto, le permitimos el acceso
        if ($user->role === $role) {
            return $next($request);
        }

        // Si no tiene acceso, mostramos el error 403
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
