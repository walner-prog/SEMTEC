<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;
    protected $table = 'lecciones';

    protected $fillable = [
        'curso_id',
        'titulo',
        'descripcion',
        'youtube_url',
        'orden',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
