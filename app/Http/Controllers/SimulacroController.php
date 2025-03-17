<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Simulacro;
use App\Models\Pregunta;
use Illuminate\Support\Carbon;
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
            'titulo'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha'             => 'required|date_format:Y-m-d\TH:i',
            'hora_fin'          => 'required|date_format:Y-m-d\TH:i|after:fecha',
            'archivo_preguntas' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        $fechaInicio = \Carbon\Carbon::parse($request->fecha);
        $fechaFin    = \Carbon\Carbon::parse($request->hora_fin);

        // Subir archivo
        $rutaArchivo = $request->file('archivo_preguntas')->store('preguntas', 'local');

        // Crear el simulacro con fecha y hora fin
        $simulacro = Simulacro::create([
            'titulo'       => $request->titulo,
            'descripcion'  => $request->descripcion,
            'fecha'        => $fechaInicio,
            'hora_fin'     => $fechaFin,
            'archivo_preguntas' => $rutaArchivo,
            'profesor_id'  => auth()->id()
        ]);

        // Leer el archivo de preguntas y guardarlas
        $filePath   = storage_path("app/$rutaArchivo");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $worksheet   = $spreadsheet->getActiveSheet();
        $rows        = $worksheet->toArray();

        foreach (array_slice($rows, 1) as $row) {
            if (count($row) < 7) {
                continue;
            }
            Pregunta::create([
                'simulacro_id'       => $simulacro->id,
                'imagen'             => !empty(trim($row[0])) ? trim($row[0]) : null,
                'texto'              => trim($row[1]),
                'opcion_a'           => trim($row[2]),
                'opcion_b'           => trim($row[3]),
                'opcion_c'           => trim($row[4]),
                'opcion_d'           => trim($row[5]),
                'respuesta_correcta' => strtoupper(substr(trim($row[6]), 0, 1)),
            ]);
        }

        return redirect()->route('profesor.simulacros.index');
    }

    public function destroy($id)
    {
        Simulacro::findOrFail($id)->delete();
        return redirect()->route('profesor.simulacros.index');
    }

    public function verSimulacros()
    {
        $userId = Auth::id();
        $fechaActual = now();

        // Todos los simulacros
        $simulacros = Simulacro::all();

        foreach ($simulacros as $simulacro) {
            // Verificar si el estudiante ya presentó el simulacro
            $simulacro->presentado = Calificacion::where('estudiante_id', $userId)
                ->where('simulacro_id', $simulacro->id)
                ->exists();

            // Comprobar si el simulacro está en rango [fecha, hora_fin]
            $inicioSimulacro = \Carbon\Carbon::parse($simulacro->fecha);
            $finSimulacro    = $simulacro->hora_fin ? \Carbon\Carbon::parse($simulacro->hora_fin) : null;

            $simulacro->disponible = $finSimulacro
                ? $fechaActual->between($inicioSimulacro, $finSimulacro)
                : $fechaActual->greaterThanOrEqualTo($inicioSimulacro);
            // Si no hay hora_fin, tal vez lo consideras disponible indefinidamente
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
        $simulacro = Simulacro::with('preguntas')->findOrFail($id);
        $preguntas = $simulacro->preguntas;

        // Verificar fin
        $horaFin = $simulacro->hora_fin ? \Carbon\Carbon::parse($simulacro->hora_fin) : null;
        if ($horaFin && now()->greaterThan($horaFin)) {
            return redirect()->route('estudiante.simulacros')->with('error', 'El tiempo del simulacro ha finalizado.');
        }

        // Calcular puntaje
        $puntajeTotal = 0;
        foreach ($preguntas as $pregunta) {
            $respuestaSeleccionada = $request->input("pregunta_{$pregunta->id}");
            if ($respuestaSeleccionada) {
                $esCorrecta = ($respuestaSeleccionada == $pregunta->respuesta_correcta);
                if ($esCorrecta) {
                    $puntajeTotal += 10;
                }
            }
        }

        // Guardar calificación total
        Calificacion::updateOrCreate(
            [
                'estudiante_id' => auth()->id(),
                'simulacro_id'  => $simulacro->id,
                'pregunta_id'   => null,
            ],
            [
                'puntaje'          => $puntajeTotal,
                'titulo_simulacro' => $simulacro->titulo,
            ]
        );

        return redirect()->route('estudiante.simulacros');
    }

    public function preview(Request $request)
    {
        // Ajusta la validación si en la previsualización también quieres capturar la hora_fin
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date_format:Y-m-d\TH:i',
            'hora_fin' => 'required|date_format:Y-m-d\TH:i|after:fecha',
            'archivo_preguntas' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Guardar temporalmente el archivo
        $filePath = $request->file('archivo_preguntas')->store('temp');

        // Leer el archivo con PhpSpreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('app/' . $filePath));
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Extraer preguntas (sin la primera fila)
        $preguntas = [];
        foreach (array_slice($rows, 1) as $row) {
            if (count($row) < 7) {
                continue;
            }
            $preguntas[] = [
                'imagen'             => isset($row[0]) && !empty($row[0]) ? trim($row[0]) : null,
                'texto'              => trim($row[1]),
                'opcion_a'           => trim($row[2]),
                'opcion_b'           => trim($row[3]),
                'opcion_c'           => trim($row[4]),
                'opcion_d'           => trim($row[5]),
                'respuesta_correcta' => strtoupper(substr(trim($row[6]), 0, 1)),
            ];
        }

        return view('profesor.preview', [
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha'       => $request->fecha,
            'hora_fin'    => $request->hora_fin,
            'archivo'     => $filePath,
            'preguntas'   => $preguntas
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
            'fecha'  => 'required|date',      // solo la parte YYYY-mm-dd
            'hora'   => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        // Combinar fecha + hora para el inicio
        $fechaInicio = \Carbon\Carbon::parse($request->fecha . ' ' . $request->hora);

        // Si quieres permitir que la fecha de fin sea otro día, necesitarías otro campo "fecha_fin".
        // De momento, usaremos la misma $request->fecha para la hora_fin:
        $fechaFin = \Carbon\Carbon::parse($request->fecha . ' ' . $request->hora_fin);

        // Actualizar
        $simulacro = Simulacro::findOrFail($id);
        $simulacro->update([
            'titulo'   => $request->titulo,
            // 'descripcion' => $request->descripcion, // solo si lo incluyes en el form
            'fecha'    => $fechaInicio,
            'hora_fin' => $fechaFin,
        ]);

        return redirect()->route('profesor.simulacros.index');
    }

    public function verificarAcceso(Simulacro $simulacro)
    {
        $ahora = now();
        $inicioSimulacro = \Carbon\Carbon::parse($simulacro->fecha . ' ' . $simulacro->hora);
        $finSimulacro = $simulacro->hora_fin ? \Carbon\Carbon::parse($simulacro->fecha . ' ' . $simulacro->hora_fin) : null;

        // Verificar si el simulacro ha iniciado
        if ($inicioSimulacro->isFuture()) {
            return redirect()->route('estudiante.simulacros')->with('error', 'El simulacro aún no ha comenzado.');
        }

        // Bloquear si la hora final pasó
        if ($simulacro->hora_fin && $ahora->greaterThan($finSimulacro)) {
            return redirect()->route('estudiante.simulacros')->with('error', 'El simulacro ha finalizado.');
        }

        return view('simulacros.show', compact('simulacro'));
    }
}
