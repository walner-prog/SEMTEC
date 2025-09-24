<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escuela extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'direccion', 'telefono', 'codigo_mined', 'municipio', 'departamento', 'pais', 'tipo', 'anio_fundacion', 'director'];

    public function grupos() {
        return $this->hasMany(Grupo::class);
    }

    public function matriculas() {
        return $this->hasMany(Matricula::class);
    }
}
