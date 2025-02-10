<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use HasFactory;

    protected $fillable = ['evento', 'fecha', 'profesor_id'];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
}
