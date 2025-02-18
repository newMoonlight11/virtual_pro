<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'subtitulo', 'contenido', 'autor_id'];

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
