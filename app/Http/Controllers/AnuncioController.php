<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index()
    {
        return view('anuncios.index');
    }

    public function create()
    {
        return view('anuncios.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar anuncio
    }

    public function edit($id)
    {
        return view('anuncios.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar anuncio
    }

    public function destroy($id)
    {
        // Lógica para eliminar anuncio
    }
}
