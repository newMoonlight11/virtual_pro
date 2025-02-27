<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect('dashboard')->with(['success' => 'Has iniciado sesión.']);
        } else {
            return back()->withErrors(['email' => 'Correo o contraseña no válidos.']);
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'Has cerrado sesión.']);
    }
}
