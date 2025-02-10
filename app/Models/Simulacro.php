<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulacro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'fecha', 'profesor_id'];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
