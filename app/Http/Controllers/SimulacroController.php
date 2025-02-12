<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simulacro;
use App\Models\Calificacion;

class SimulacroController extends Controller
{
    public function index()
    {
        $simulacros = Simulacro::all();
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
        $simulacro = Simulacro::findOrFail($id);
        return view('estudiante.realizar-simulacro', compact('simulacro'));
    }

    public function guardarRespuestas(Request $request, $id)
    {
        $simulacro = Simulacro::findOrFail($id);

        // Simulación de calificación: Generar puntaje aleatorio entre 0 y 100
        $puntaje = rand(50, 100);

        Calificacion::create([
            'estudiante_id' => auth()->user()->id,
            'simulacro_id' => $simulacro->id,
            'puntaje' => $puntaje,
        ]);

        return redirect()->route('estudiante.simulacros')->with('success', "Simulacro completado. Tu puntaje es: $puntaje");
    }
}
