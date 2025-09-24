<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'grados';

    protected $fillable = ['nombre', 'descripcion', 'orden'];

    public function unidades()
    {
        return $this->hasMany(Unidad::class, 'grado_id');
    }
public function docentes() {
    return $this->belongsToMany(User::class, 'grado_user');
}

public function estudiantes() {
    return $this->belongsToMany(User::class, 'grado_user')->whereDoesntHave('roles', fn($q) => $q->where('name', 'Docente'));
}
}
