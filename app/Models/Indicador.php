<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'indicadores';

    protected $fillable = ['competencia_id', 'titulo', 'descripcion', 'codigo', 'orden'];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'competencia_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'indicador_id');
    }
}
