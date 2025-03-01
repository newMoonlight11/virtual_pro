<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar el usuario
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario existe y si tiene rol y contraseña asignados
        if (!$user || !$user->password || !$user->role) {
            return back()->withErrors(['email' => 'Tu cuenta aún no ha sido activada por un administrador.']);
        }

        // Intentar autenticación
        if (Auth::attempt($attributes, $request->filled('remember'))) {
            session()->regenerate();
            if ($request->filled('remember')) {
                Cookie::queue('email', $request->email, 43200); // Guarda el email por 30 días
            } else {
                Cookie::queue(Cookie::forget('email')); // Borra la cookie si no marcó "Recordarme"
            }
            return redirect('dashboard');
        } else {
            return back()->withErrors(['email' => 'Correo o contraseña no válidos.']);
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/login');
    }
}
