<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Simulacro;
use App\Models\User;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesor.dashboard'); // Vista principal del profesor
    }



    public function calificaciones()
    {
        $calificaciones = Calificacion::with('estudiante', 'simulacro')->get();
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
        return view('profesor.cronograma');
    }

    public function obtenerEventos()
    {
        $eventos = [];

        // Obtener simulacros y convertirlos en eventos del calendario
        $simulacros = Simulacro::all();
        foreach ($simulacros as $simulacro) {
            $eventos[] = [
                'title' => 'Simulacro: ' . $simulacro->titulo,
                'start' => $simulacro->fecha,
                'color' => '#28a745' // Verde para simulacros
            ];
        }

        return response()->json($eventos);
    }

    public function modulos()
    {
        $modulos = Modulo::all();
        return view('profesor.modulos', compact('modulos'));
    }

    public function crearModulo()
    {
        return view('profesor.crear-modulo');
    }

    public function guardarModulo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Modulo::create($request->all());

        return redirect()->route('profesor.modulos')->with('success', 'Módulo creado correctamente.');
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
        ]);

        $modulo = Modulo::findOrFail($id);
        $modulo->update($request->all());

        return redirect()->route('profesor.modulos')->with('success', 'Módulo actualizado correctamente.');
    }

    public function eliminarModulo($id)
    {
        Modulo::findOrFail($id)->delete();
        return redirect()->route('profesor.modulos')->with('success', 'Módulo eliminado correctamente.');
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
