<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
    
    public function index()
    {
        $anuncio = Anuncio::latest()->first(); // Obtiene el anuncio más reciente
        return view('dashboard', compact('anuncio'));
    }
}
