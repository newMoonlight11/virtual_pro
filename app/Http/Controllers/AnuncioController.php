<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::where('autor_id', auth()->user()->id)->get();
        return view('profesor.anuncios', compact('anuncios'));
    }

    public function create()
    {
        return view('profesor.crear-anuncio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        Anuncio::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'autor_id' => auth()->user()->id,
        ]);

        return redirect()->route('profesor.anuncios')->with('success', 'Anuncio publicado correctamente.');
    }

    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        if ($anuncio->autor_id !== auth()->user()->id) {
            abort(403);
        }

        $anuncio->delete();
        return redirect()->route('profesor.anuncios')->with('success', 'Anuncio eliminado correctamente.');
    }

    public function verAnuncios()
    {
        $anuncios = Anuncio::latest()->get();
        return view('estudiante.anuncios', compact('anuncios'));
    }
}
