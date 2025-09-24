<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'actividades';

    protected $fillable = [
        'indicador_id',
        'titulo',
        'objetivo',
        'tipo',
        'accesibilidad_flags',
        'media_video',
        'media_documento',
        'dificultad_min',
        'dificultad_max',
        'orden',
         'con_tiempo',     
        'limite_tiempo', 
    ];

    protected $casts = [
        'accesibilidad_flags' => 'array',
        'media_json' => 'array',
        'dificultad_min' => 'integer',
        'dificultad_max' => 'integer',
    ];

    public function indicador()
    {
        return $this->belongsTo(Indicador::class, 'indicador_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'actividad_id');
    }

    public function intentos()
    {
        return $this->hasMany(Intento::class, 'actividad_id');
    }
}
