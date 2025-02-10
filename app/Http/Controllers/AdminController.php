<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user-management', compact('users'));
    }
    public function create()
    {
        return view('admin.create-user'); // Vista para el formulario de registro
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
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
            'role' => 'required|in:admin,profesor,estudiante',
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,profesor,estudiante',
        ]);

        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente.');
    }
}
