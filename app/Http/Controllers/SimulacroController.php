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

        foreach (array_slice($rows, 1) as $row) {
            if (count($row) < 7) {
                continue; // Si hay menos de 7 columnas, la fila se ignora
            }

            Pregunta::create([
                'simulacro_id' => $simulacro->id,
                'imagen' => isset($row[0]) && !empty($row[0]) ? trim($row[0]) : null,
                'texto' => trim($row[1]),
                'opcion_a' => trim($row[2]),
                'opcion_b' => trim($row[3]),
                'opcion_c' => trim($row[4]),
                'opcion_d' => trim($row[5]),
                'respuesta_correcta' => strtoupper(substr(trim($row[6]), 0, 1)), // Solo una letra
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
            // Verificar que la fila tiene el número correcto de columnas
            if (count($row) < 7) {
                continue; // Si la fila tiene menos de 7 columnas, se ignora para evitar errores
            }

            $preguntas[] = [
                'imagen' => isset($row[0]) && !empty($row[0]) ? trim($row[0]) : null, // Imagen en la primera columna
                'texto' => trim($row[1] ?? 'Pregunta no especificada'), // Pregunta en la segunda columna
                'opcion_a' => trim($row[2] ?? ''),
                'opcion_b' => trim($row[3] ?? ''),
                'opcion_c' => trim($row[4] ?? ''),
                'opcion_d' => trim($row[5] ?? ''),
                'respuesta_correcta' => strtoupper(substr(trim($row[6] ?? 'A'), 0, 1)), // Solo A, B, C o D
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
