<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiembroGrupo extends Model
{
    use HasFactory;

    protected $table = 'miembros_grupo';
    protected $fillable = ['grupo_id', 'user_id', 'rol'];

    public function grupo() {
        return $this->belongsTo(Grupo::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

