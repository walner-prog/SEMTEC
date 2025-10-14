<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioJuego extends Model
{
    use HasFactory;

    protected $table = 'usuario_juego';

    protected $fillable = [
        'user_id', 'juego_id', 'puntaje', 'intentos', 'completado',
        'racha_actual', 'racha_maxima', 'dias_jugados', 'ultima_partida'
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logros()
    {
        return $this->usuario->logros()->wherePivot('juego_id', $this->juego_id);
    }
}

