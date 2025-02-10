<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesor.dashboard'); // Vista principal del profesor
    }

    public function calificaciones()
    {
        return view('profesor.calificaciones');
    }

    public function cronograma()
    {
        return view('profesor.cronograma');
    }

    public function modulos()
    {
        return view('profesor.modulos');
    }

    public function simulacros()
    {
        return view('profesor.simulacros');
    }

    public function anuncios()
    {
        return view('profesor.anuncios');
    }
}
