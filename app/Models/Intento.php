<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intento extends Model
{
    use HasFactory;

    protected $table = 'intentos';

    protected $fillable = [
        'actividad_id',
        'item_id',
        'user_id',
        'inicio',
        'fin',
        'aciertos',
        'errores',
        'tiempo_seg',
        'ayuda_usada',
        'puntaje',
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fin' => 'datetime',
        'ayuda_usada' => 'array',
    ];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // En App\Models\Intento
public function revision()
{
    return $this->hasOne(Revision::class, 'intento_id');
}
}
