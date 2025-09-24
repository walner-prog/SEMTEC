<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recompensa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recompensas';

    protected $fillable = [
        'clave',
        'tipo',
        'icono_url',
        'descripcion',
        'puntos_requeridos',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_recompensa')
                    ->withPivot('fecha')
                    ->withTimestamps();
    }
}
