<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulacroController extends Controller
{
    public function index()
    {
        return view('simulacros.index');
    }

    public function create()
    {
        return view('simulacros.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar simulacro
    }

    public function show($id)
    {
        return view('simulacros.show', compact('id'));
    }

    public function destroy($id)
    {
        // Lógica para eliminar simulacro
    }
}
