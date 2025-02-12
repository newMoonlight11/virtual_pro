<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Cronograma;
use App\Models\Modulo;
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
        $eventos = Cronograma::where('profesor_id', auth()->user()->id)->get();
        return view('profesor.cronograma', compact('eventos'));
    }

    public function editarCronograma($id)
    {
        $evento = Cronograma::findOrFail($id);
        return view('profesor.editar-cronograma', compact('evento'));
    }

    public function actualizarCronograma(Request $request, $id)
    {
        $request->validate([
            'evento' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        $evento = Cronograma::findOrFail($id);
        $evento->update($request->all());

        return redirect()->route('profesor.cronograma')->with('success', 'Evento actualizado.');
    }

    public function eliminarCronograma($id)
    {
        Cronograma::findOrFail($id)->delete();
        return redirect()->route('profesor.cronograma')->with('success', 'Evento eliminado.');
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

    public function anuncios()
    {
        return view('profesor.anuncios');
    }
}
