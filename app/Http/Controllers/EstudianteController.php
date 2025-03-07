<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Simulacro;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.dashboard'); // Vista principal del estudiante
    }

    public function calificaciones()
    {
        $calificaciones = Calificacion::where('estudiante_id', auth()->id())
            ->whereNull('pregunta_id') // Solo trae los registros de puntaje total
            ->with('simulacro') // Carga la relación con el simulacro
            ->get();

        return view('estudiante.calificaciones', compact('calificaciones'));
    }

    public function cronograma()
    {
        $eventos = Cronograma::all(); // Carga todos los eventos creados por los profesores
        return view('estudiante.cronograma', compact('eventos'));
    }

    public function modulos(Request $request)
    {
        $query = Modulo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $modulos = $query->latest()->get();

        return view('estudiante.modulos', compact('modulos'));
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
