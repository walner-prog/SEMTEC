<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Escuela;
use App\Models\Matricula;
use Spatie\Permission\Models\Role;

class EscuelaSeeder extends Seeder
{
    public function run(): void
    {
        // ------------------------------
        // 1️⃣ Crear Escuela
        // ------------------------------
        $escuela = Escuela::create([
            'nombre' => 'Escuela Primaria La Esperanza',
            'municipio' => 'Managua',
            'departamento' => 'Managua',
            'codigo_mined' => 'ESPERANZA-001',
            'tipo' => 'Pública',
            'anio_fundacion' => 2005,
            'director' => 'Juan Pérez'
        ]);

        // ------------------------------
        // 2️⃣ Crear Roles si no existen
        // ------------------------------
        Role::firstOrCreate(['name' => 'docente']);
        Role::firstOrCreate(['name' => 'estudiante']);
        Role::firstOrCreate(['name' => 'tutor']);
        

        // ------------------------------
        // 3️⃣ Crear un Docente (como User)
        // ------------------------------
        $docente = User::create([
            'name' => 'Ana Pérez',
            'username' => 'ana',
            'email' => 'ana@escuela.edu.ni',
            'password' => bcrypt('12345678'),
            'escuela_id' => $escuela->id
        ]);
        $docente->assignRole('docente');

        // ------------------------------
        // 4️⃣ Crear Estudiantes (como Users) y asignar matrícula
        // ------------------------------
        $estudiantesData = [
            ['name' => 'Carlos', 'username' => 'carlos123', 'email'=>'carlos@escuela.edu.ni','grado'=>2,'seccion'=>'A','accesibilidad'=>[]],
            ['name' => 'María', 'username' => 'maria456', 'email'=>'maria@escuela.edu.ni','grado'=>2,'seccion'=>'A','accesibilidad'=>['tts'=>true]],
            ['name' => 'José', 'username' => 'jose789', 'email'=>'jose@escuela.edu.ni','grado'=>3,'seccion'=>'B','accesibilidad'=>[]],
        ];

        foreach($estudiantesData as $estData) {
            $user = User::create([
                'name' => $estData['name'],
                'username' => $estData['username'],
                'email' => $estData['email'],
                'password' => bcrypt('12345678'),
                'escuela_id' => $escuela->id,
                'preferencias_accesibilidad' => json_encode($estData['accesibilidad'])
            ]);
            $user->assignRole('estudiante');

            // Crear matrícula
            Matricula::create([
                'user_id' => $user->id,
                'escuela_id' => $escuela->id,
                'anio' => date('Y'),
                'grado' => $estData['grado'],
                'seccion' => $estData['seccion']
            ]);
        }
    }
}
