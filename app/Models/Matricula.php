<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matricula extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matriculas';

    protected $fillable = [
        'user_id',
        'escuela_id',
        'docente_id',
        'grado',
        'seccion',
        'anio',
        'fecha_matricula',
        'observaciones',
    ];

    protected $casts = [
        'fecha_matricula' => 'date',
        'anio' => 'integer',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuela_id');
    }
        // Relación al docente
    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function grado()
{
    return $this->belongsTo(Grado::class, 'grado_id');
}


}
