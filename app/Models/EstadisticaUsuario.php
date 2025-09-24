<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadisticaUsuario extends Model
{
    protected $table = 'estadisticas_usuarios';

    protected $fillable = [
        'user_id',
        'puntos',
        'monedas',
        'trofeos',
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
