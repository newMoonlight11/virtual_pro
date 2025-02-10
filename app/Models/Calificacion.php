<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id', 'simulacro_id', 'puntaje'];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function simulacro()
    {
        return $this->belongsTo(Simulacro::class, 'simulacro_id');
    }
}
