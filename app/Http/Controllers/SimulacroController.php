<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Simulacro;
use App\Models\Pregunta;

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
            'archivo_preguntas' => 'required|string'
        ]);

        // Crear el simulacro
        $simulacro = Simulacro::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'profesor_id' => auth()->id()
        ]);

        // Leer el archivo de preguntas
        $filePath = storage_path('app/' . $request->archivo_preguntas);
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Guardar preguntas en la base de datos
        foreach (array_slice($rows, 1) as $row) {
            Pregunta::create([
                'simulacro_id' => $simulacro->id,
                'texto' => $row[0],
                'opcion_a' => $row[1],
                'opcion_b' => $row[2],
                'opcion_c' => $row[3],
                'opcion_d' => $row[4],
                'respuesta_correcta' => strtoupper($row[5]),
            ]);
        }

        return redirect()->route('profesor.simulacros.index')->with('success', 'Simulacro creado y preguntas importadas correctamente.');
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

    public function preview(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'archivo_preguntas' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Guardar temporalmente el archivo
        $filePath = $request->file('archivo_preguntas')->store('temp');

        // Leer el archivo con PhpSpreadsheet
        $spreadsheet = IOFactory::load(storage_path('app/' . $filePath));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Extraer preguntas (sin la primera fila, que son los encabezados)
        $preguntas = [];
        foreach (array_slice($rows, 1) as $row) {
            $preguntas[] = [
                'texto' => $row[0], // Pregunta
                'opcion_a' => $row[1],
                'opcion_b' => $row[2],
                'opcion_c' => $row[3],
                'opcion_d' => $row[4],
                'respuesta_correcta' => strtoupper($row[5]), // Convertir a mayúsculas
            ];
        }

        return view('profesor.preview', [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'archivo' => $filePath,
            'preguntas' => $preguntas
        ]);
    }
}
