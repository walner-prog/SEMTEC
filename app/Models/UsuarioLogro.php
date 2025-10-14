<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioLogro extends Model
{
    use HasFactory;

    protected $table = 'usuario_logro';

    protected $fillable = [
        'user_id', 'logro_id', 'fecha_obtenido', 'juego_id'
    ];
}
