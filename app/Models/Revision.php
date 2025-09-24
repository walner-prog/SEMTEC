<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table = 'revisiones';

    protected $fillable = [
        'intento_id',
        'docente_id',
        'revisado',
        'retroalimentacion',
        'calificacion',
        'fecha_revision'
    ];

    protected $casts = [
        'revisado' => 'boolean',
        'fecha_revision' => 'datetime'
    ];

    public function intento()
    {
        return $this->belongsTo(Intento::class);
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}