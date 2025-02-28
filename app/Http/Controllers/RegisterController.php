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
            'phone' => 'nullable|digits_between:7,15', // Validación para números de teléfono
            'agreement' => 'accepted', // Validar que aceptó los términos
        ]);

        // Se crea el usuario sin contraseña ni rol
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Ahora sí se guarda el teléfono
            'password' => null, // No tiene contraseña aún
            'role' => null, // Sin rol asignado
        ]);

        // Guardamos un mensaje en la sesión
        Session::flash('success', 'Se ha registrado con éxito. Prontamente nos contactaremos contigo.');

        // Se mantiene en la misma página sin iniciar sesión
        return back();
    }
}
