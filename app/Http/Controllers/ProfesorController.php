<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Simulacro;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesor.dashboard'); // Vista principal del profesor
    }



    public function calificaciones(Request $request)
    {
        $query = Calificacion::with('estudiante', 'simulacro')
            ->whereNull('pregunta_id') // Solo puntajes totales
            ->orderByDesc('created_at');

        // Filtros dinámicos por cada columna
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('estudiante', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
                ->orWhereHas('simulacro', function ($q) use ($search) {
                    $q->where('titulo', 'like', "%{$search}%");
                })
                ->orWhere('puntaje', 'like', "%{$search}%")
                ->orWhereDate('created_at', 'like', "%{$search}%");
        }

        $calificaciones = $query->get();
        return view('profesor.calificaciones', compact('calificaciones'));
    }

    public function editarCalificacion($id)
    {
        $calificacion = Calificacion::findOrFail($id);
        return view('profesor.editar-calificacion', compact('calificacion'));
    }

    public function actualizarCalificacion(Request $request, $id)
    {
        $request->validate([
            'puntaje' => 'required|integer|min:0|max:100',
        ]);

        $calificacion = Calificacion::findOrFail($id);
        $calificacion->puntaje = $request->puntaje;
        $calificacion->save();

        return redirect()->route('profesor.calificaciones')->with('success', 'Calificación actualizada.');
    }

    public function eliminarCalificacion($id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();

        return redirect()->route('profesor.calificaciones')->with('success', 'Calificación eliminada.');
    }


    public function cronograma()
    {
        $eventos = Cronograma::where('profesor_id', auth()->id())->get();
        return view('profesor.cronograma', compact('eventos'));
    }

    public function guardarEvento(Request $request)
    {
        $request->validate([
            'evento' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        Cronograma::create([
            'evento' => $request->evento,
            'fecha' => $request->fecha,
            'profesor_id' => auth()->id(),
        ]);

        return redirect()->route('profesor.cronograma');
    }

    public function actualizarEvento(Request $request, $id)
    {
        $request->validate([
            'evento' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $evento = Cronograma::findOrFail($id);
        $evento->update([
            'evento' => $request->evento,
            'fecha' => $request->fecha . ' ' . $request->hora, // Concatenamos la fecha con la hora
        ]);

        return redirect()->route('profesor.cronograma');
    }

    public function eliminarEvento($id)
    {
        Cronograma::findOrFail($id)->delete();
        return redirect()->route('profesor.cronograma');
    }

    public function modulos(Request $request)
    {
        $query = Modulo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $modulos = $query->latest()->get();

        return view('profesor.modulos', compact('modulos'));
    }

    public function crearModulo()
    {
        return view('profesor.crear-modulo');
    }

    // En guardarModulo()
    public function guardarModulo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'link_reunion' => 'nullable|string', // Quitamos la validación "url"
            'archivos.*' => 'file|max:10240',
            'nombres_personalizados' => 'nullable|string',
        ]);

        // Prepara el link de reunión: si se ingresó y no empieza con http(s)://, se le antepone https://
        $link_reunion = $request->link_reunion;
        if ($link_reunion && !preg_match('/^https?:\/\//i', $link_reunion)) {
            $link_reunion = 'https://' . $link_reunion;
        }

        // Crear el módulo incluyendo el link de la reunión virtual
        $modulo = Modulo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'link_reunion' => $link_reunion,
        ]);

        // Procesar archivos (igual que antes)
        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            $nombresPersonalizados = explode("\n", trim($request->nombres_personalizados));

            foreach ($archivos as $index => $archivo) {
                $rutaArchivo = $archivo->store('modulos', 'public');
                $nombreArchivo = trim($nombresPersonalizados[$index] ?? $archivo->getClientOriginalName());
                Archivo::create([
                    'modulo_id' => $modulo->id,
                    'nombre' => $nombreArchivo,
                    'ruta' => $rutaArchivo,
                ]);
            }
        }

        return redirect()->route('profesor.modulos');
    }

    public function editarModulo($id)
    {
        $modulo = Modulo::findOrFail($id);
        return view('profesor.editar-modulo', compact('modulo'));
    }

    public function actualizarModulo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'link_reunion' => 'nullable|string', // Quitamos "url"
        ]);

        $modulo = Modulo::findOrFail($id);

        $link_reunion = $request->link_reunion;
        if ($link_reunion && !preg_match('/^https?:\/\//i', $link_reunion)) {
            $link_reunion = 'https://' . $link_reunion;
        }

        $modulo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'link_reunion' => $link_reunion,
        ]);

        return redirect()->route('profesor.modulos');
    }

    public function eliminarModulo($id)
    {
        Modulo::findOrFail($id)->delete();
        return redirect()->route('profesor.modulos');
    }

    public function subirArchivo(Request $request, $id)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf|max:10240', // Solo PDF, máximo 10MB
            'nombre_personalizado' => 'nullable|string|max:255',
        ]);

        $modulo = Modulo::findOrFail($id);
        $archivo = $request->file('archivo');

        $rutaArchivo = $archivo->store('modulos', 'public');

        $nombreArchivo = $request->nombre_personalizado ?: $archivo->getClientOriginalName();

        Archivo::create([
            'modulo_id' => $modulo->id,
            'nombre' => $nombreArchivo,
            'ruta' => $rutaArchivo,
        ]);

        return back();
    }

    public function eliminarArchivo($id)
    {
        $archivo = Archivo::findOrFail($id);

        // Eliminar el archivo físico
        Storage::disk('public')->delete($archivo->ruta);

        // Eliminar el registro de la base de datos
        $archivo->delete();

        return back();
    }


    public function simulacros()
    {
        return view('profesor.simulacros');
    }

    public function crearPregunta($simulacro_id)
    {
        return view('profesor.crear-pregunta', compact('simulacro_id'));
    }

    public function guardarPregunta(Request $request, $simulacro_id)
    {
        $request->validate([
            'enunciado' => 'required|string',
            'opciones' => 'required|array|min:4',
            'correcta' => 'required|integer',
        ]);

        $pregunta = Pregunta::create([
            'simulacro_id' => $simulacro_id,
            'enunciado' => $request->enunciado,
        ]);

        foreach ($request->opciones as $index => $opcion) {
            Respuesta::create([
                'pregunta_id' => $pregunta->id,
                'opcion' => $opcion,
                'es_correcta' => $index == $request->correcta,
            ]);
        }

        return redirect()->route('profesor.simulacros')->with('success', 'Pregunta agregada correctamente.');
    }

    public function anuncios()
    {
        return view('profesor.anuncios');
    }
}
