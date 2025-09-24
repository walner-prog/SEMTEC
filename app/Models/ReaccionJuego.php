<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReaccionJuego extends Model
{
    protected $table = 'reacciones_juegos';

    protected $fillable = [
        'user_id',
        'juego_id',
        'tipo',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }
}
