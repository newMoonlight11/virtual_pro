<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'simulacro_id',
        'texto',
        'opcion_a',
        'opcion_b',
        'opcion_c',
        'opcion_d',
        'respuesta_correcta'
    ];
    public function simulacro()
    {
        return $this->belongsTo(Simulacro::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
