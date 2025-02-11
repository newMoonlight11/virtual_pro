<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return redirect()->route(
                $role === 'admin' ? 'admin.usuarios' : ($role === 'profesor' ? 'profesor.dashboard' : 'estudiante.dashboard')
            );
        }

        return $next($request);
    }
}
