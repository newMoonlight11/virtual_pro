<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.dashboard'); // Vista principal del estudiante
    }

    public function calificaciones()
    {
        $calificaciones = Calificacion::where('estudiante_id', auth()->user()->id)->get();
        return view('estudiante.calificaciones', compact('calificaciones'));
    }

    public function cronograma()
    {
        return view('estudiante.cronograma');
    }

    public function modulos()
    {
        return view('estudiante.modulos');
    }

    public function anuncios()
    {
        return view('estudiante.anuncios');
    }

    public function simulacros()
    {
        return view('estudiante.simulacros');
    }
}
