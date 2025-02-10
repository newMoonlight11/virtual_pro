<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.dashboard'); // Vista principal del estudiante
    }

    public function calificaciones()
    {
        return view('estudiante.calificaciones');
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
