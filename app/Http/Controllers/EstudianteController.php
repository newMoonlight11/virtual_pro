<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Simulacro;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.dashboard'); // Vista principal del estudiante
    }

    public function calificaciones()
    {
        $calificaciones = Calificacion::where('estudiante_id', auth()->id())
            ->whereNull('pregunta_id') // Filtramos solo puntajes totales
            ->with('simulacro') // Asegura que cargue la relación con Simulacro
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

    public function guardarRespuestas(Request $request, $id)
    {
        $simulacro = Simulacro::findOrFail($id);
        $preguntas = $simulacro->preguntas;
        $puntajeTotal = 0;

        foreach ($preguntas as $pregunta) {
            $respuestaSeleccionada = $request->input("pregunta_{$pregunta->id}");

            if ($respuestaSeleccionada) {
                $esCorrecta = ($respuestaSeleccionada == $pregunta->respuesta_correcta);
                if ($esCorrecta) {
                    $puntajeTotal += 10; // Suma 10 puntos por cada respuesta correcta
                }

                // Guardar cada respuesta individual
                Calificacion::updateOrCreate(
                    [
                        'estudiante_id' => auth()->id(),
                        'simulacro_id' => $simulacro->id,
                        'pregunta_id' => $pregunta->id,
                    ],
                    [
                        'respuesta' => $respuestaSeleccionada,
                        'es_correcta' => $esCorrecta,
                        'puntaje' => $esCorrecta ? 10 : 0, // Guarda puntaje individual por pregunta
                    ]
                );
            }
        }

        // Guardar el puntaje total del simulacro
        Calificacion::updateOrCreate(
            [
                'estudiante_id' => auth()->id(),
                'simulacro_id' => $simulacro->id,
                'pregunta_id' => null, // Identificador de puntaje total
            ],
            [
                'puntaje' => $puntajeTotal,
            ]
        );

        return redirect()->route('estudiante.simulacros')->with('success', "Simulacro completado. Tu puntaje es: $puntajeTotal");
    }
}
