<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Simulacro;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function index()
    {
        $anuncio = Anuncio::latest()->first();
        $modulo = Modulo::latest()->first();
        $eventos = Cronograma::orderBy('fecha', 'asc')->take(6)->get(); // Obtiene los próximos 6 eventos ordenados por fecha

        $totalUsuarios = User::count();

        // 2️⃣ Usuarios registrados hoy
        $usuariosHoy = User::whereDate('created_at', Carbon::today())->count();

        // 3️⃣ Nuevos usuarios en los últimos 7 días
        $nuevosUsuarios = User::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count();

        // 4️⃣ Días para el próximo simulacro
        $proximoSimulacro = Simulacro::where('fecha', '>=', Carbon::now())
            ->orderBy('fecha', 'asc')
            ->first();

        if ($proximoSimulacro) {
            $horasFaltantes = Carbon::now()->diffInHours($proximoSimulacro->fecha);
            $diasFaltantes = Carbon::now()->diffInDays($proximoSimulacro->fecha);

            if ($horasFaltantes < 24) {
                $diasParaSimulacro = '1';
            } else {
                $diasParaSimulacro = $diasFaltantes . ' días';
            }
        } else {
            $diasParaSimulacro = 'Ninguno';
        }

        return view('dashboard', compact('anuncio', 'modulo', 'eventos', 'totalUsuarios', 'usuariosHoy', 'nuevosUsuarios', 'diasParaSimulacro'));
    }
}
