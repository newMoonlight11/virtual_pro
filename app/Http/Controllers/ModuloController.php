<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        return view('modulos.index');
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
