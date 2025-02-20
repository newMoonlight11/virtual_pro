<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Cronograma;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function index()
    {
        $anuncio = Anuncio::latest()->first(); // Obtiene el anuncio más reciente
        $eventos = Cronograma::orderBy('fecha', 'asc')->take(6)->get(); // Obtiene los próximos 6 eventos ordenados por fecha
        return view('dashboard', compact('anuncio', 'eventos'));
    }
}
