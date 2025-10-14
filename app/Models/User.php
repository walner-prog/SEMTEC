<?php
namespace App\Models;

 
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;




class User extends Authenticatable  
{
  

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'tutor_id',
        'email',
        'password',
        'profile_photo_path',
        'deleted_at',
        'delete_profile_photo_path',
        'xp',

    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   // en App\Models\User
public function matriculas() { return $this->hasMany(Matricula::class, 'user_id'); }
public function intentos() { return $this->hasMany(Intento::class, 'user_id'); }
public function recompensas() { return $this->belongsToMany(Recompensa::class, 'usuario_recompensa')->withPivot('fecha'); }
public function escuela() {
    return $this->belongsTo(Escuela::class);
}
public function grados() { 
    return $this->belongsToMany(Grado::class, 'grado_user');
}



public function juegos()
{
    return $this->belongsToMany(Juego::class, 'usuario_juego')
        ->withPivot(['puntaje','intentos','completado','ultima_partida'])
        ->withTimestamps();
}

public function logros()
{
    return $this->belongsToMany(Logro::class, 'usuario_logro')
        ->withPivot('fecha_obtenido', 'juego_id') // <-- aquí debe incluir juego_id
        ->withTimestamps();
}


 
public function estadisticas()
{
    return $this->hasOne(EstadisticaUsuario::class, 'user_id');
}


// Un tutor puede tener varios hijos
public function hijos()
{
    return $this->hasMany(User::class, 'tutor_id');
}

// Un estudiante pertenece a un tutor
public function tutor()
{
    return $this->belongsTo(User::class, 'tutor_id');
}


 

public function getProfilePhotoUrlAttribute(): string
{
    return $this->profile_photo_path
        ? $this->profile_photo_path  // Ya es URL completa de Imgbb
        : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
}


    
 

}
