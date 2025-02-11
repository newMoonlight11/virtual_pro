<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[\W]/',
                'confirmed'
            ],
            'role' => 'required|in:profesor,estudiante',
        ], [
            'password.regex' => 'La contraseña debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // Redirigir según el rol
        return redirect()->route($user->role === 'profesor' ? 'profesor.dashboard' : 'estudiante.dashboard');
    }
}
