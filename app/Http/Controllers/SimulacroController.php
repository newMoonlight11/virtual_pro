<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simulacro;
use App\Models\Calificacion;

class SimulacroController extends Controller
{
    public function index(Request $request)
    {
        $query = Simulacro::query();

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $simulacros = $query->latest()->get();

        return view('profesor.simulacros', compact('simulacros'));
    }

    public function create()
    {
        return view('profesor.crear-simulacro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);

        Simulacro::create($request->all());

        return redirect()->route('profesor.simulacros.index')->with('success', 'Simulacro creado correctamente.');
    }

    public function destroy($id)
    {
        Simulacro::findOrFail($id)->delete();
        return redirect()->route('profesor.simulacros.index')->with('success', 'Simulacro eliminado correctamente.');
    }

    public function verSimulacros()
    {
        $simulacros = Simulacro::latest()->get();
        return view('estudiante.simulacros', compact('simulacros'));
    }

    public function realizarSimulacro($id)
    {
        $simulacro = Simulacro::with('preguntas.respuestas')->findOrFail($id);
        return view('estudiante.realizar-simulacro', compact('simulacro'));
    }

    public function guardarRespuestas(Request $request, $id)
    {
        $simulacro = Simulacro::findOrFail($id);
        $preguntas = $simulacro->preguntas;
        $puntaje = 0;

        foreach ($preguntas as $pregunta) {
            $respuestaSeleccionada = $request->input("pregunta_{$pregunta->id}");

            if ($respuestaSeleccionada) {
                $esCorrecta = ($respuestaSeleccionada == $pregunta->respuesta_correcta);

                if ($esCorrecta) {
                    $puntaje += 10; // Suma 10 puntos por cada respuesta correcta
                }

                // Guardar cada respuesta en la tabla calificacions
                Calificacion::create([
                    'estudiante_id' => auth()->id(),
                    'simulacro_id' => $simulacro->id,
                    'pregunta_id' => $pregunta->id,
                    'respuesta' => $respuestaSeleccionada,
                    'es_correcta' => $esCorrecta
                ]);
            }
        }

        return redirect()->route('estudiante.simulacros')->with('success', "Simulacro completado. Tu puntaje es: $puntaje");
    }
}
