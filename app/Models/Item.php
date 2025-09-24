<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';

    protected $fillable = [
        'actividad_id',
        'enunciado',
        'datos',
        'respuesta',
        'retro',
        'orden',
    ];

    protected $casts = [
        'datos' => 'array',
        'respuesta' => 'array',
        'retro' => 'array',
    ];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    public function intentos()
    {
        return $this->hasMany(Intento::class, 'item_id');
    }
}
