<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'string',
                'min:8',              // Mínimo 8 caracteres
                'regex:/[A-Z]/',      // Al menos una mayúscula
                'regex:/[a-z]/',      // Al menos una minúscula
                'regex:/[0-9]/',      // Al menos un número
                'regex:/[\W]/',       // Al menos un carácter especial
                'confirmed'           // Debe coincidir con password_confirmation
            ],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);



        session()->flash('success', 'Tu cuenta ha sido creada');
        $user = User::create($attributes);
        Auth::login($user);
        return redirect('/dashboard');
    }
}
