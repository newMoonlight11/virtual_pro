<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index(Request $request)
    {
        $query = Modulo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $modulos = $query->latest()->get();

        return view('profesor.modulos', compact('modulos'));
    }

    public function create()
    {
        return view('modulos.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar módulo
    }

    public function edit($id)
    {
        return view('modulos.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar módulo
    }

    public function destroy($id)
    {
        // Lógica para eliminar módulo
    }
}
