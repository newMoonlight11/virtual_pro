<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Simulacro;

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
    public function guardarRespuestas(Request $request, $id)
    {
        $simulacro = Simulacro::findOrFail($id);
        $preguntas = $simulacro->preguntas;
        $puntaje = 0;

        foreach ($preguntas as $pregunta) {
            $respuestaSeleccionada = $request->input("pregunta_{$pregunta->id}");

            if ($respuestaSeleccionada) {
                $respuestaCorrecta = $pregunta->respuestas()->where('es_correcta', true)->first();
                if ($respuestaCorrecta && $respuestaCorrecta->id == $respuestaSeleccionada) {
                    $puntaje += 10; // Suma 10 puntos por cada respuesta correcta
                }
            }
        }

        Calificacion::create([
            'estudiante_id' => auth()->user()->id,
            'simulacro_id' => $simulacro->id,
            'puntaje' => $puntaje,
        ]);

        return redirect()->route('estudiante.simulacros')->with('success', "Simulacro completado. Tu puntaje es: $puntaje");
    }
}
