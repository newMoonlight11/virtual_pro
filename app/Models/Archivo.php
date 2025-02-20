<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = ['modulo_id', 'nombre', 'ruta'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
