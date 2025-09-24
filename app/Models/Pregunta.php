<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = [
        'juego_id',
        'enunciado',
        'opciones',
        'respuesta_correcta'
    ];

    protected $casts = [
        'opciones' => 'array',
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class);
    }
}
