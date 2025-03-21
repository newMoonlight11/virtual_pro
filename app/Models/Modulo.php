<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'link_reunion'];

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
