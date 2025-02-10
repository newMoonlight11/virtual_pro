<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        return view('calificaciones.index');
    }

    public function create()
    {
        return view('calificaciones.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar calificación
    }

    public function edit($id)
    {
        return view('calificaciones.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar calificación
    }

    public function destroy($id)
    {
        // Lógica para eliminar calificación
    }
}
