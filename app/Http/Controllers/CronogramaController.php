<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        return view('cronograma.index');
    }

    public function create()
    {
        return view('cronograma.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar evento en el cronograma
    }

    public function edit($id)
    {
        return view('cronograma.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar evento en el cronograma
    }

    public function destroy($id)
    {
        // Lógica para eliminar evento del cronograma
    }
}
