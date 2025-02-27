<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register'); // Asegúrate de que esta vista existe
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Se crea el usuario sin contraseña ni rol
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => null, // No tiene contraseña aún
            'role' => null, // Sin rol asignado
        ]);

        // Guardamos un mensaje en la sesión
        Session::flash('success', 'Se ha registrado con éxito. Prontamente nos contactaremos contigo.');

        // Se mantiene en la misma página sin iniciar sesión
        return back();
    }
}
