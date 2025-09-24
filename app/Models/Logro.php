<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titulo', 'descripcion', 'icono', 'puntos_requeridos', 'juego_id'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_logro')
            ->withPivot('fecha_obtenido')
            ->withTimestamps();
    }

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }
}
