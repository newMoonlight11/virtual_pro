<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

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
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirigir según el rol
            return redirect()->route($user->role === 'admin' ? 'admin.usuarios' : ($user->role === 'profesor' ? 'profesor.dashboard' : 'estudiante.dashboard'));
        }

        return back()->withErrors(['email' => 'Las credenciales no son correctas.']);
    }
}
