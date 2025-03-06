<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Simulacro;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();
        $fechaActual = now();

        // Obtener todos los simulacros
        $simulacros = Simulacro::all();

        foreach ($simulacros as $simulacro) {
            // Verificar si ya fue presentado
            $simulacro->presentado = Calificacion::where('estudiante_id', $userId)
                ->where('simulacro_id', $simulacro->id)
                ->exists();

            // Verificar si la fecha del simulacro ya ha llegado
            $simulacro->disponible = $fechaActual >= $simulacro->fecha;
        }

        return view('estudiante.simulacros', compact('simulacros'));
    }

    public function realizarSimulacro($id)
    {
        $userId = Auth::id();
        $simulacro = Simulacro::with('preguntas')->findOrFail($id);

        // Comprobar si el usuario ya presentó el simulacro
        $presentado = Calificacion::where('estudiante_id', $userId)
            ->where('simulacro_id', $simulacro->id)
            ->exists();

        if ($presentado) {
            return redirect()->route('estudiante.simulacros')->with('error', 'Ya realizaste este simulacro.');
        }

        // Comprobar si la fecha y hora ya han llegado
        if (now() < $simulacro->fecha) {
            return redirect()->route('estudiante.simulacros')->with('error', 'Este simulacro aún no está disponible.');
        }

        return view('estudiante.realizar-simulacro', compact('simulacro'));
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

        return redirect()->route('estudiante.simulacros');
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
            if (count($row) < 7) {
                continue; // Si la fila tiene menos de 7 columnas, se ignora
            }

            // $imagenPath = null;

            // if (!empty(trim($row[0]))) {
            //     $nombreArchivo = trim($row[0]);
            //     $rutaImagen = 'public/imagenes_simulacros/' . $nombreArchivo;

            //     if (Storage::exists($rutaImagen)) {
            //         $imagenPath = 'imagenes_simulacros/' . $nombreArchivo;
            //     }
            // }

            $preguntas[] = [
                'imagen' => isset($row[0]) && !empty($row[0]) ? trim($row[0]) : null, // Imagen en la primera columna,
                'texto' => trim($row[1]),
                'opcion_a' => trim($row[2]),
                'opcion_b' => trim($row[3]),
                'opcion_c' => trim($row[4]),
                'opcion_d' => trim($row[5]),
                'respuesta_correcta' => strtoupper(substr(trim($row[6]), 0, 1)), // Solo una letra
            ];
        }

        return view('profesor.preview', [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'archivo' => $filePath,
            'preguntas' => $preguntas // Ahora las preguntas solo se previsualizan, no se guardan en la BD
        ]);
    }

    public function test($id)
    {
        $simulacro = Simulacro::with('preguntas')->findOrFail($id);
        return view('profesor.test', compact('simulacro'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required', // Asegurar que 'hora' está validado
        ]);

        $simulacro = Simulacro::findOrFail($id);
        $simulacro->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha . ' ' . $request->hora,
            'profesor_id' => auth()->id()
        ]);

        return redirect()->route('profesor.simulacros.index');
    }
}
