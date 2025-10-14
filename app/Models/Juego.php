<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Juego extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre', 'descripcion', 'icono', 'puntos_base', 'tipo','bloqueado', 'requisito_puntos', 'requisito_monedas', 'requisito_trofeos', 'nivel', 'categoria'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_juego')
            ->withPivot(['puntaje','intentos','completado','ultima_partida'])
            ->withTimestamps();
    }

    public function logros()
    {
        return $this->hasMany(Logro::class, 'juego_id');
    }

    public function preguntas()
{
    return $this->hasMany(Pregunta::class);
}

public function reacciones()
{
    return $this->hasMany(ReaccionJuego::class, 'juego_id');
}

}
