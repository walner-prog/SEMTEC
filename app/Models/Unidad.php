<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unidades';

    protected $fillable = ['grado_id', 'titulo', 'descripcion', 'orden','docente_id'];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'unidad_id');
    }
}
