<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'competencias';

    protected $fillable = ['unidad_id', 'titulo', 'descripcion', 'orden'];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'competencia_id');
    }
}
