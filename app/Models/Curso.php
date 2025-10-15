<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'categoria',
        'publicado',
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class)->orderBy('orden');
    }
}
