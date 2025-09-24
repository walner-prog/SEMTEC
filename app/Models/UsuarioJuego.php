<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioJuego extends Model
{
    use HasFactory;

    protected $table = 'usuario_juego';

    protected $fillable = [
        'user_id', 'juego_id', 'puntaje', 'intentos', 'completado', 'ultima_partida'
    ];
}
