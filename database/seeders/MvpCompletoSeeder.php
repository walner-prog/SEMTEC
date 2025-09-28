<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Escuela;
use App\Models\Matricula;
use App\Models\Grado;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\Actividad;
use App\Models\Item;
use Spatie\Permission\Models\Role;

class MvpCompletoSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Crear Escuela
        $escuela = Escuela::create([
            'nombre' => 'Escuela Primaria La Esperanza',
            'municipio' => 'Leon',
            'departamento' => 'León',
            'codigo_mined' => 'ESPERANZA-001',
            'tipo' => 'Pública',
            'anio_fundacion' => 2005,
            'director' => 'Juan Pérez'
        ]);

        // 2️⃣ Crear Roles
        foreach (['Docente', 'Estudiante', 'Tutor'] as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }

        // 3️⃣ Crear Grados
        $gradosData = [
            1 => ['nombre' => '1º', 'descripcion' => 'Primer grado de primaria'],
            2 => ['nombre' => '2º', 'descripcion' => 'Segundo grado de primaria'],
            3 => ['nombre' => '3º', 'descripcion' => 'Tercer grado de primaria'],
            4 => ['nombre' => '4º', 'descripcion' => 'Cuarto grado de primaria'],
            5 => ['nombre' => '5º', 'descripcion' => 'Quinto grado de primaria'],
            6 => ['nombre' => '6º', 'descripcion' => 'Sexto grado de primaria'],

        ];

        $grados = [];
        foreach ($gradosData as $num => $data) {
            $grados[$num] = Grado::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'orden' => $num,
                'escuela_id' => $escuela->id,
            ]);
        }


        // 4️⃣ Crear Docentes y asignarles un grado cada uno
        $docentesData = [
            1 => ['name' => 'Sandra López', 'username' => 'sandra', 'email' => 'sandra.lopez@escuela.edu.ni'],
            2 => ['name' => 'Mario Ramírez', 'username' => 'mario', 'email' => 'mario.ramirez@escuela.edu.ni'],
            3 => ['name' => 'Ana Torres', 'username' => 'ana', 'email' => 'ana.torres@escuela.edu.ni'],
            4 => ['name' => 'Jorge Martínez', 'username' => 'jorge', 'email' => 'jorge.martinez@escuela.edu.ni'],
            5 => ['name' => 'Luisa Fernández', 'username' => 'luisa', 'email' => 'luisa.fernandez@escuela.edu.ni'],
            6 => ['name' => 'Miguel Castillo', 'username' => 'miguel', 'email' => 'miguel.castillo@escuela.edu.ni'],
        ];

        foreach ($grados as $grado) {
            $data = $docentesData[$grado->orden]; // obtener el docente según el orden del grado
            $docente = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt('12345'),
                'escuela_id' => $escuela->id
            ]);

            $docente->assignRole('Docente');
            $docente->grados()->attach($grado->id); // asignar docente solo a su grado
        }


        // 5️⃣ Crear Estudiantes y asignarles grado y sección


        $estudiantesData = [
            ['name' => 'Sofía López', 'username' => 'sofia', 'email' => 'sofia.lopez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Mateo Ramírez', 'username' => 'mateo', 'email' => 'mateo.ramirez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Valeria Hernández', 'username' => 'valeria', 'email' => 'valeria.hernandez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Sebastián García', 'username' => 'sebastian', 'email' => 'sebastian.garcia@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Martínez', 'username' => 'camila', 'email' => 'camila.martinez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Daniel Torres', 'username' => 'daniel', 'email' => 'daniel.torres@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Isabella Castro', 'username' => 'isabella', 'email' => 'isabella.castro@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Lucas Rodríguez', 'username' => 'lucas', 'email' => 'lucas.rodriguez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'María Fernanda Pérez', 'username' => 'maria', 'email' => 'maria.perez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Andrés Cruz', 'username' => 'andres', 'email' => 'andres.cruz@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Lucía Morales', 'username' => 'lucia', 'email' => 'lucia.morales@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Gabriel Núñez', 'username' => 'gabriel', 'email' => 'gabriel.nunez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Alejandra Flores', 'username' => 'alejandra', 'email' => 'alejandra.flores@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Emiliano Rivas', 'username' => 'emiliano', 'email' => 'emiliano.rivas@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Daniela Sánchez', 'username' => 'daniela', 'email' => 'daniela.sanchez@escuela.edu.ni', 'grado' => 1, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Mateo López', 'username' => 'mateo05', 'email' => 'mateo.lopez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Valentina Ramírez', 'username' => 'valentina', 'email' => 'valentina.ramirez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Diego Hernández', 'username' => 'diego', 'email' => 'diego.hernandez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Mariana García', 'username' => 'mariana', 'email' => 'mariana.garcia@escuela.edu.ni', 'grado' => 2, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Santiago Martínez', 'username' => 'santiago', 'email' => 'santiago.martinez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Isabella Torres', 'username' => 'isabella', 'email' => 'isabella.torres@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Lucas Castro', 'username' => 'lucas', 'email' => 'lucas.castro@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Rodríguez', 'username' => 'camila', 'email' => 'camila.rodriguez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Gabriel Pérez', 'username' => 'gabriel', 'email' => 'gabriel.perez@escuela.edu.ni', 'grado' => 2, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Lucía Cruz', 'username' => 'lucia', 'email' => 'lucia.cruz@escuela.edu.ni', 'grado' => 2, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Alejandro Morales', 'username' => 'alejandro', 'email' => 'alejandro.morales@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Sofía Ramírez', 'username' => 'sofia', 'email' => 'sofia.ramirez@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Daniel Ortega', 'username' => 'daniel', 'email' => 'daniel.ortega@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Valeria Castillo', 'username' => 'valeria', 'email' => 'valeria.castillo@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Joaquín Sánchez', 'username' => 'joaquin', 'email' => 'joaquin.sanchez@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Mendoza', 'username' => 'camila', 'email' => 'camila.mendoza@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Mateo Vargas', 'username' => 'mateo04', 'email' => 'mateo.vargas@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Luciana Herrera', 'username' => 'luciana', 'email' => 'luciana.herrera@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Sebastián Paredes', 'username' => 'sebastian', 'email' => 'sebastian.paredes@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Isabella Núñez', 'username' => 'isabella', 'email' => 'isabella.nunez@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Emiliano Torres', 'username' => 'emiliano', 'email' => 'emiliano.torres@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Renata Flores', 'username' => 'renata', 'email' => 'renata.flores@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Thiago Jiménez', 'username' => 'thiago', 'email' => 'thiago.jimenez@escuela.edu.ni', 'grado' => 3, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'María Fernanda Cruz', 'username' => 'mariafernanda', 'email' => 'mariafernanda.cruz@escuela.edu.ni', 'grado' => 3, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Diego Fernández', 'username' => 'diego', 'email' => 'diego.fernandez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Rodríguez', 'username' => 'camila', 'email' => 'camila.rodriguez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Matías González', 'username' => 'matias', 'email' => 'matias.gonzalez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Valentina Ramírez', 'username' => 'valentina', 'email' => 'valentina.ramirez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Lucas Martínez', 'username' => 'lucas', 'email' => 'lucas.martinez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Isabella López', 'username' => 'isabella', 'email' => 'isabella.lopez@escuela.edu.ni', 'grado' => 4, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Santiago Torres', 'username' => 'santiago', 'email' => 'santiago.torres@escuela.edu.ni', 'grado' => 4, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Renata Silva', 'username' => 'renata', 'email' => 'renata.silva@escuela.edu.ni', 'grado' => 4, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Emiliano Navarro', 'username' => 'emiliano', 'email' => 'emiliano.navarro@escuela.edu.ni', 'grado' => 4, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Mariana Herrera', 'username' => 'mariana', 'email' => 'mariana.herrera@escuela.edu.ni', 'grado' => 4, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Mateo Rojas', 'username' => 'mateo03', 'email' => 'mateo.rojas@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Sofía Mendoza', 'username' => 'sofia', 'email' => 'sofia.mendoza@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Thiago Vargas', 'username' => 'thiago', 'email' => 'thiago.vargas@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Lucía Herrera', 'username' => 'lucia', 'email' => 'lucia.herrera@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Diego Paredes', 'username' => 'diego', 'email' => 'diego.paredes@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Valentina Castro', 'username' => 'valentina', 'email' => 'valentina.castro@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Emiliano Rivas', 'username' => 'emiliano', 'email' => 'emiliano.rivas@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Figueroa', 'username' => 'camila', 'email' => 'camila.figueroa@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Matías Suárez', 'username' => 'matias', 'email' => 'matias.suarez@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Isabella Jiménez', 'username' => 'isabella', 'email' => 'isabella.jimenez@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Santiago Lozano', 'username' => 'santiago', 'email' => 'santiago.lozano@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Renata Morales', 'username' => 'renata', 'email' => 'renata.morales@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Lucas Alvarado', 'username' => 'lucas', 'email' => 'lucas.alvarado@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Mariana Peña', 'username' => 'mariana', 'email' => 'mariana.pena@escuela.edu.ni', 'grado' => 5, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Alejandro Soto', 'username' => 'alejandro', 'email' => 'alejandro.soto@escuela.edu.ni', 'grado' => 5, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Juan Carlos Méndez', 'username' => 'juan', 'email' => 'juan.mendez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Camila Rojas', 'username' => 'camila', 'email' => 'camila.rojas@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Diego Fernández', 'username' => 'diego', 'email' => 'diego.fernandez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Valeria López', 'username' => 'valeria', 'email' => 'valeria.lopez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Santiago Ramírez', 'username' => 'santiago', 'email' => 'santiago.ramirez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Isabella Torres', 'username' => 'isabella', 'email' => 'isabella.torres@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Matías Castillo', 'username' => 'matias', 'email' => 'matias.castillo@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Lucía Morales', 'username' => 'lucia', 'email' => 'lucia.morales@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Emiliano Pérez', 'username' => 'emiliano', 'email' => 'emiliano.perez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Renata Jiménez', 'username' => 'renata', 'email' => 'renata.jimenez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Alejandro Salinas', 'username' => 'alejandro', 'email' => 'alejandro.salinas@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Mariana Fuentes', 'username' => 'mariana', 'email' => 'mariana.fuentes@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Lucas Paredes', 'username' => 'lucas', 'email' => 'lucas.paredes@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Valentina Castro', 'username' => 'valentina', 'email' => 'valentina.castro@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],
            ['name' => 'Thiago Ramírez', 'username' => 'thiago', 'email' => 'thiago.ramirez@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Sofía Herrera', 'username' => 'sofia', 'email' => 'sofia.herrera@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => []],
            ['name' => 'Mateo Vargas', 'username' => 'mateo2', 'email' => 'mateo.vargas@escuela.edu.ni', 'grado' => 6, 'seccion' => 'A', 'accesibilidad' => []],
            ['name' => 'Luciana Rivas', 'username' => 'luciana', 'email' => 'luciana.rivas@escuela.edu.ni', 'grado' => 6, 'seccion' => 'B', 'accesibilidad' => ['tts' => true]],

        ];


        foreach ($estudiantesData as $estData) {
            // 🔹 Generar username único
            $usernameBase = $estData['username'];
            $counter = 1;
            while (User::where('username', $estData['username'])->exists()) {
                $estData['username'] = $usernameBase . $counter;
                $counter++;
            }

            // 🔹 Generar email único
            $emailBase = explode('@', $estData['email'])[0];
            $emailDomain = explode('@', $estData['email'])[1];
            $emailCounter = 1;
            while (User::where('email', $estData['email'])->exists()) {
                $estData['email'] = $emailBase . $emailCounter . '@' . $emailDomain;
                $emailCounter++;
            }

            // 🔹 Crear usuario
            $user = User::create([
                'name' => $estData['name'],
                'username' => $estData['username'],
                'email' => $estData['email'],
                'password' => bcrypt('12345'),
                'escuela_id' => $escuela->id,
                'preferencias_accesibilidad' => json_encode($estData['accesibilidad'])
            ]);
            $user->assignRole('Estudiante');

            // 🔹 Crear matrícula
            Matricula::create([
                'user_id' => $user->id,
                'docente_id' => $docente->id,
                'escuela_id' => $escuela->id,
                'anio' => date('Y'),
                'grado' => $estData['grado'],
                'seccion' => $estData['seccion']
            ]);

            // 🔹 Asignar estudiante al grado (tabla pivote grado_user)
            $user->grados()->attach($estData['grado']);
        }


   


        // 6️⃣ Crear Unidades, Competencias e Indicadores
      $unidadesCompetenciasIndicadores = [
    1 => [
        [
            'unidad' => 'Unidad 1: Números hasta 20',
            'descripcion' => 'Contar, sumar y restar hasta 20',
            'competencia' => [
                'titulo' => 'Contar y escribir números',
                'indicador' => 'Escribe los números 1-20'
            ]
        ],
        [
            'unidad' => 'Unidad 2: Formas y patrones',
            'descripcion' => 'Identificar formas geométricas y patrones',
            'competencia' => [
                'titulo' => 'Reconocer formas',
                'indicador' => 'Identifica círculos, cuadrados y triángulos'
            ]
        ]
    ],
    2 => [
        [
            'unidad' => 'Unidad 1:Suma y resta',
            'descripcion' => 'Sumar y restar hasta 20',
            'competencia' => [
                'titulo' => 'Sumar y restar números',
                'indicador' => 'Sumar y restar números hasta 20'
            ]
        ],
        [
            'unidad' => 'Unidad 2: sumas de 3 numeros ',
            'descripcion' => 'Sumar números  1-2-3 cifras',
            'competencia' => [
                'titulo' => 'Sumar  números de 1-2-3 cifras',
                'indicador' => 'Sumar  números 1-2-3 cifras',
            ]
        ],
        [
            'unidad' => 'Unidad 3: contar numeros hasta 20',
            'descripcion' => 'Contar números hasta 20',
            'competencia' => [
                'titulo' => 'Contar números hasta 20',
                'indicador' => 'Cuenta números hasta 20',
            ]
        ],
        [
            'unidad' => 'Unidad 4: tabla de multiplicar del 2',
            'descripcion' => 'Aprender la tabla de multiplicar del 2',
            'competencia' => [
                'titulo' => 'Tabla de multiplicar del 2',
                'indicador' => 'Recita la tabla de multiplicar del 2',
            ]
        ]
    ],
    3 => [
        [
            'unidad' => 'Unidad 1: Multiplicación y división',
            'descripcion' => 'Multiplicar y dividir números 1-2 cifras',
            'competencia' => [
                'titulo' => 'Multiplicación como suma repetida',
                'indicador' => 'Representa multiplicaciones'
            ]
        ],
        [
            'unidad' => 'Unidad 2: Medición y geometría',
            'descripcion' => 'Medir, dibujar y calcular perímetro',
            'competencia' => [
                'titulo' => 'Medición',
                'indicador' => 'Mide longitud'
            ]
        ]
    ],
    4 => [
        [
            'unidad' => 'Unidad 1: Fracciones y decimales',
            'descripcion' => 'Introducción a fracciones y decimales',
            'competencia' => [
                'titulo' => 'Comprender fracciones',
                'indicador' => 'Representa y compara fracciones simples'
            ]
        ],
        [
            'unidad' => 'Unidad 2: Geometría avanzada',
            'descripcion' => 'Ángulos, polígonos y simetría',
            'competencia' => [
                'titulo' => 'Identificar figuras',
                'indicador' => 'Reconoce ángulos y polígonos'
            ]
        ]
    ],
    5 => [
        [
            'unidad' => 'Unidad 1: Álgebra básica',
            'descripcion' => 'Expresiones algebraicas y ecuaciones simples',
            'competencia' => [
                'titulo' => 'Resolver ecuaciones',
                'indicador' => 'Resuelve ecuaciones de primer grado'
            ]
        ],
        [
            'unidad' => 'Unidad 2: Estadística y probabilidad',
            'descripcion' => 'Datos, tablas y probabilidad simple',
            'competencia' => [
                'titulo' => 'Interpretar datos',
                'indicador' => 'Lee e interpreta gráficos y tablas'
            ]
        ]
    ],
    6 => [
        [
            'unidad' => 'Unidad 1: Álgebra avanzada',
            'descripcion' => 'Ecuaciones y expresiones más complejas',
            'competencia' => [
                'titulo' => 'Operar con expresiones',
                'indicador' => 'Simplifica y resuelve expresiones algebraicas'
            ]
        ],
        [
            'unidad' => 'Unidad 2: Geometría y trigonometría',
            'descripcion' => 'Triángulos, perímetro, área y razones trigonométricas',
            'competencia' => [
                'titulo' => 'Aplicar trigonometría',
                'indicador' => 'Calcula áreas y longitudes usando trigonometría básica'
            ]
        ]
    ]
];


        $indicadoresModels = [];

     foreach ($unidadesCompetenciasIndicadores as $gradoNum => $unidades) {
    // Obtener el docente asignado a este grado
    $docenteDelGrado = User::role('Docente')->whereHas('grados', function($q) use ($grados, $gradoNum) {
        $q->where('grado_id', $grados[$gradoNum]->id);
    })->first();

    foreach ($unidades as $uniIdx => $uniData) {
        $unidad = Unidad::create([
            'grado_id' => $grados[$gradoNum]->id,
            'docente_id' => $docenteDelGrado->id,
            'titulo' => $uniData['unidad'],
            'descripcion' => $uniData['descripcion'],
            'orden' => $uniIdx + 1
        ]);

        $competencia = Competencia::create([
            'unidad_id' => $unidad->id,
            'titulo' => $uniData['competencia']['titulo'],
            'descripcion' => null,
            'orden' => 1
        ]);

        $indicador = Indicador::create([
            'competencia_id' => $competencia->id,
            'titulo' => $uniData['competencia']['indicador'],
            'descripcion' => 'Aplicación práctica del indicador',
            'orden' => 1
        ]);

        $indicadoresModels[$gradoNum][$uniIdx] = $indicador;
    }
}

$actividadesPorUnidad = [

    // Grado 1
    1 => [
        [
            'unidad' => 0,
            'titulo' => 'sumas y restas básicas',
            'objetivo' => 'Contar, sumar y restar hasta 20',
            'items' => [
                ['enunciado' => '3 + 2 = ?', 'respuesta' => '5'],
                ['enunciado' => '4 - 1 = ?', 'respuesta' => '3'],
                ['enunciado' => '2 + 2 = ?', 'respuesta' => '4'],
                ['enunciado' => '¿Verdadero o falso? v si es verdadero o f si es falso 2 + 2 = 5', 'respuesta' => 'f'],
                ['enunciado' => '5 + 2 = ?', 'respuesta' => '7'],
                ['enunciado' => '6 - 3 = ?', 'respuesta' => '3'],
                ['enunciado' => '3 - 0 = ?', 'respuesta' => '3'],
                ['enunciado' => '5 - 0 = ?', 'respuesta' => '5'],
                ['enunciado' => '¿Verdadero o falso? v si es verdadero o f si es falso 4 + 1 = 6', 'respuesta' => 'f'],
                ['enunciado' => '1 + 1 + 1 = ?', 'respuesta' => '3']
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'sumas y restas con objetos',
            'objetivo' => 'sumar y restar usando objetos',
            'items' => [
                ['enunciado' => 'si tengo 2 círculos y dibujo 1 más, ¿cuántos círculos tengo?', 'respuesta' => '3'],
                ['enunciado' => 'si tengo 3 cuadrados y dibujo 1 más, ¿cuántos cuadrados tengo?', 'respuesta' => '4'],
                ['enunciado' => 'si tengo 1 triángulo y dibujo 2 más, ¿cuántos triángulos tengo?', 'respuesta' => '3'],
                ['enunciado' => '¿Verdadero o falso? v si es verdadero o f si es falso Un triángulo tiene 3 lados', 'respuesta' => 'v'],
                ['enunciado' => 'si tengo 5 cuadrados y dibujo 1 más, ¿cuántos cuadrados tengo?', 'respuesta' => '6'],
                ['enunciado' => 'si tengo 8 círculos y dibujo 1 más, ¿cuántos círculos tengo?', 'respuesta' => '9'],
                ['enunciado' => 'si tengo 3 triángulos y se me pierde 1 , ¿cuántos triángulos tengo?', 'respuesta' => '2'],
               
            ]
        ]
    ],

    // Grado 2
    2 => [
        [
            'unidad' => 0,
            'titulo' => 'Sumas y restas hasta 30',
            'objetivo' => 'Resolver operaciones básicas',
            'items' => [
                ['enunciado' => '25 +  = ?', 'respuesta' => '28'],
                ['enunciado' => '15 + 10 = ?', 'respuesta' => '25'],
                ['enunciado' => '30 - 5 = ?', 'respuesta' => '25'],
                ['enunciado' => 'Completa: 20 + ___ = 30', 'respuesta' => '10'],
                ['enunciado' => '29 - 9 = ?', 'respuesta' => '20'],
                ['enunciado' => 'Selecciona la suma correcta: 12 + 8', 'respuesta' => '20'],
                ['enunciado' => '18 - 3 = ?', 'respuesta' => '15'],
                ['enunciado' => 'Completa: 30 - ___ = 10', 'respuesta' => '20'],
                ['enunciado' => 'Verdadero o falso: 5 + 5 = 15', 'respuesta' => 'falso'],
              
                ['enunciado' => '80 - 45 = ?', 'respuesta' => '35'],
                ['enunciado' => 'Completa: 10 + ___ = 30', 'respuesta' => '20'],
              
                ['enunciado' => 'Escribe la suma correcta: 15 + 4', 'respuesta' => '19'],
                ['enunciado' => '30 - 20 = ?', 'respuesta' => '10'],
                ['enunciado' => '30 - 10 = ?', 'respuesta' => '20'],
                ['enunciado' => 'Completa: 50 - ___ = 25', 'respuesta' => '25'],
             
               
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'sumas de 3 numeros ',
            'objetivo' => 'Que el estudiante aprenda a sumar 3 numeros',
            'items' => [
                ['enunciado' => '5 + 3 + 2 = ?', 'respuesta' => '10'],
                ['enunciado' => '4 + 4 + 4 = ?', 'respuesta' => '12'],
                ['enunciado' => '1 + 2 + 3 = ?', 'respuesta' => '6'],
                ['enunciado' => '¿Verdadero o falso? v si es verdadero o f si es falso 2 + 2 + 2 = 5', 'respuesta' => 'f'],
                ['enunciado' => '2 + 2 + 1 = ?', 'respuesta' => '5'],
                ['enunciado' => '3 + 6 + 3 = ?', 'respuesta' => '12'],
                ['enunciado' => '2 + 5 + 7 = ?', 'respuesta' => '14'],
                ['enunciado' => '4 + 1 + 9 = ?', 'respuesta' => '14'],
                ['enunciado' => '¿Verdadero o falso? v si es verdadero o f si es falso 1 + 1 + 1 = 4', 'respuesta' => 'f'],
                ['enunciado' => '7 + 2 + 2 = ?', 'respuesta' => '11']
            ]
            ],
             [
            'unidad' => 2,
            'titulo' => 'contar numeros asta el 20',
            'objetivo' => 'contar numeros asta el 20',
            'items' => [
                ['enunciado' => '¿Cuántos números hay del 1 al 20?', 'respuesta' => '20'],
                ['enunciado' => 'Cuenta: 1, 2, 3, ___, 5', 'respuesta' => '4'],
                ['enunciado' => 'Completa si es mas de un numero : 10, ___, ___, 13', 'respuesta' => '11, 12'],
                ['enunciado' => '¿Qué número sigue? 18, 19, ___', 'respuesta' => '20'],
                ['enunciado' => 'Cuenta hacia atrás: 20, 19, ___', 'respuesta' => '18'],
                ['enunciado' => 'Completa: 1, 2, ___, 4 horas', 'respuesta' => '3'],
                ['enunciado' => 'completa: 0, 1, 2, ___', 'respuesta' => '3'],
                ['enunciado' => '¿Qué número viene después del 15?', 'respuesta' => '16'],
                ['enunciado' => 'Cuenta hacia atrás: 5, 4, ___', 'respuesta' => '3'],
                ['enunciado' => 'Completa: 7, 8, ___, 10', 'respuesta' => '9'],
                ['enunciado' => 'Completa: 5 + 1 = ___ horas', 'respuesta' => '6'],
                
            ]
        ],
         [
            'unidad' => 3,
            'titulo' => 'tabla de multiplicar del 2',
            'objetivo' => 'aprender la tabla de multiplicar del 2',
            'items' => [
                ['enunciado' => '2 x 1 = ___', 'respuesta' => '2'],
                ['enunciado' => '2 x 2 = ___', 'respuesta' => '4'],
                ['enunciado' => '2 x 3 = ___', 'respuesta' => '6'],
                ['enunciado' => '2 x 4 = ___', 'respuesta' => '8'],
                ['enunciado' => '2 x 5 = ___', 'respuesta' => '10'],
                ['enunciado' => '2 x 6 = ___', 'respuesta' => '12'],
                ['enunciado' => '2 x 7 = ___', 'respuesta' => '14'],
                ['enunciado' => '2 x 8 = ___', 'respuesta' => '16'],
                ['enunciado' => '2 x 9 = ___', 'respuesta' => '18'],
                ['enunciado' => '2 x 10 = ___', 'respuesta' => '20'],
                 
                
            ]
        ]
    ],

    // Grado 3
    3 => [
        [
            'unidad' => 0,
            'titulo' => 'Multiplicaciones simples',
            'objetivo' => 'Multiplicar usando suma repetida',
            'items' => [
                ['enunciado' => '3 x 4 = ?', 'respuesta' => '12'],
                ['enunciado' => '5 x 2 = ?', 'respuesta' => '10'],
                ['enunciado' => 'Verdadero o falso: 4 x 4 = 16', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: 2 x ___ = 8', 'respuesta' => '4'],
                ['enunciado' => 'Selecciona el resultado correcto: 3 x 3', 'respuesta' => '9'],
                ['enunciado' => '4 x 5 = ?', 'respuesta' => '20'],
                ['enunciado' => 'Verdadero o falso: 5 x 0 = 5', 'respuesta' => 'Falso'],
                ['enunciado' => 'Completa: 6 x 2 = ___', 'respuesta' => '12'],
                ['enunciado' => 'Selecciona el resultado de 7 x 1', 'respuesta' => '7'],
                ['enunciado' => '3 x 5 = ?', 'respuesta' => '15']
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'Medición de longitudes',
            'objetivo' => 'Medir y calcular perímetros simples',
            'items' => [
                ['enunciado' => 'Calcula el perímetro de un rectángulo de 3x5', 'respuesta' => '16'],
                ['enunciado' => 'Calcula el perímetro de un cuadrado de 4', 'respuesta' => '16'],
                ['enunciado' => 'Verdadero o falso: Un cuadrado tiene 4 lados iguales', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Selecciona el perímetro correcto de un rectángulo 2x6', 'respuesta' => '16'],
                ['enunciado' => 'Completa: Lado 3 + Lado 3 + Lado 3 + Lado 3 = ___', 'respuesta' => '12'],
                ['enunciado' => 'Perímetro de un triángulo 3,4,5', 'respuesta' => '12'],
                ['enunciado' => 'Verdadero o falso: El perímetro se mide sumando los lados', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Selecciona la figura que tiene perímetro 12', 'respuesta' => 'Cuadrado de lado 3'],
                ['enunciado' => 'Completa: Perímetro de rectángulo 5x7 = ___', 'respuesta' => '24'],
                ['enunciado' => 'Perímetro de cuadrado 6', 'respuesta' => '24']
            ]
        ]
    ],

    // Grado 4
    4 => [
        [
            'unidad' => 0,
            'titulo' => 'Fracciones básicas',
            'objetivo' => 'Identificar y comparar fracciones',
            'items' => [
                ['enunciado' => 'Escribe 1/2 como decimal', 'respuesta' => '0.5'],
                ['enunciado' => 'Escribe 3/4 como decimal', 'respuesta' => '0.75'],
                ['enunciado' => 'Verdadero o falso: 2/4 = 1/2', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: 1/4 + ___ = 1/2', 'respuesta' => '1/4'],
                ['enunciado' => 'Selecciona la fracción mayor: 2/3 o 3/5', 'respuesta' => '2/3'],
                ['enunciado' => 'Dibuja 1/3 de un círculo', 'respuesta' => '1/3'],
                ['enunciado' => 'Completa: 2/5 = ?/10', 'respuesta' => '4'],
                ['enunciado' => 'Verdadero o falso: 5/10 = 1/2', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Selecciona la fracción equivalente a 3/6', 'respuesta' => '1/2'],
                ['enunciado' => 'Completa: 3/4 - 1/4 = ___', 'respuesta' => '1/2']
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'Área y perímetro',
            'objetivo' => 'Calcular área y perímetro de figuras geométricas',
            'items' => [
                ['enunciado' => 'Perímetro de un cuadrado de lado 5', 'respuesta' => '20'],
                ['enunciado' => 'Área de un cuadrado de lado 4', 'respuesta' => '16'],
                ['enunciado' => 'Verdadero o falso: Área de rectángulo = base x altura', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: Perímetro de rectángulo 3x7 = ___', 'respuesta' => '20'],
                ['enunciado' => 'Selecciona el área correcta de triángulo base 4 altura 3', 'respuesta' => '6'],
                ['enunciado' => 'Perímetro de pentágono lado 6', 'respuesta' => '30'],
                ['enunciado' => 'Verdadero o falso: Un cuadrado tiene área lado²', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: Área de cuadrado lado 10 = ___', 'respuesta' => '100'],
                ['enunciado' => 'Selecciona el perímetro correcto de rectángulo 5x10', 'respuesta' => '30'],
                ['enunciado' => 'Área de triángulo 6x4', 'respuesta' => '12']
            ]
        ]
    ],

    // Grado 5
    5 => [
        [
            'unidad' => 0,
            'titulo' => 'Decimales y porcentajes',
            'objetivo' => 'Convertir y operar con decimales y porcentajes',
            'items' => [
                ['enunciado' => 'Convierte 0.25 a porcentaje', 'respuesta' => '25%'],
                ['enunciado' => 'Convierte 75% a decimal', 'respuesta' => '0.75'],
                ['enunciado' => 'Suma 0.5 + 0.25', 'respuesta' => '0.75'],
                ['enunciado' => 'Resta 0.9 - 0.3', 'respuesta' => '0.6'],
                ['enunciado' => 'Verdadero o falso: 50% = 0.5', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: 25% de 200 = ___', 'respuesta' => '50'],
                ['enunciado' => 'Selecciona el número mayor: 0.5, 0.75, 0.25', 'respuesta' => '0.75'],
                ['enunciado' => 'Multiplica 0.2 x 5', 'respuesta' => '1'],
                ['enunciado' => 'Divide 0.8 ÷ 0.4', 'respuesta' => '2'],
                ['enunciado' => 'Incrementa 50 en 20%', 'respuesta' => '60']
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'Ángulos y geometría',
            'objetivo' => 'Identificar y medir ángulos',
            'items' => [
                ['enunciado' => 'Un ángulo recto mide?', 'respuesta' => '90'],
                ['enunciado' => 'Un ángulo llano mide?', 'respuesta' => '180'],
                ['enunciado' => 'Un ángulo completo mide?', 'respuesta' => '360'],
                ['enunciado' => 'Dibuja un ángulo de 45°', 'respuesta' => '45'],
                ['enunciado' => 'Dibuja un ángulo de 120°', 'respuesta' => '120'],
                ['enunciado' => 'Verdadero o falso: Ángulo agudo < 90°', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Selecciona el ángulo obtuso > 90°', 'respuesta' => '120'],
                ['enunciado' => 'Completa: 30° + 60° = ___', 'respuesta' => '90'],
                ['enunciado' => 'Resta 180° - 45° = ___', 'respuesta' => '135'],
                ['enunciado' => 'Verdadero o falso: Ángulo recto = 90°', 'respuesta' => 'Verdadero']
            ]
        ]
    ],

    // Grado 6
    6 => [
        [
            'unidad' => 0,
            'titulo' => 'Proporciones y relaciones',
            'objetivo' => 'Resolver problemas de proporcionalidad',
            'items' => [
                ['enunciado' => 'Si 2 lápices cuestan 4 córdobas, 5 lápices cuestan?', 'respuesta' => '10'],
                ['enunciado' => 'Si 3 manzanas cuestan 9, 6 manzanas cuestan?', 'respuesta' => '18'],
                ['enunciado' => 'Completa: 4/8 = ?/16', 'respuesta' => '8'],
                ['enunciado' => 'Verdadero o falso: 5/10 = 1/2', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Selecciona la proporción correcta: 6/12 = ?/24', 'respuesta' => '12'],
                ['enunciado' => 'Si 6 camisetas cuestan 60, 1 camiseta cuesta?', 'respuesta' => '10'],
                ['enunciado' => 'Completa: 3/6 = ?/12', 'respuesta' => '6'],
                ['enunciado' => 'Si 10 kg cuestan 50, 5 kg cuestan?', 'respuesta' => '25'],
                ['enunciado' => 'Selecciona la relación correcta: 7 cuadernos = 21, 3 cuadernos = ___', 'respuesta' => '9'],
                ['enunciado' => 'Verdadero o falso: Si 8 litros cuestan 32, 2 litros cuestan 8', 'respuesta' => 'Verdadero']
            ]
        ],
        [
            'unidad' => 1,
            'titulo' => 'Estadística básica',
            'objetivo' => 'Calcular media, moda y mediana',
            'items' => [
                ['enunciado' => 'Encuentra la media de 2,4,6,8,10', 'respuesta' => '6'],
                ['enunciado' => 'Encuentra la moda de 1,2,2,3,4', 'respuesta' => '2'],
                ['enunciado' => 'Encuentra la mediana de 3,5,7', 'respuesta' => '5'],
                ['enunciado' => 'Verdadero o falso: Media = suma de valores / cantidad', 'respuesta' => 'Verdadero'],
                ['enunciado' => 'Completa: Media de 5,10,15 = ___', 'respuesta' => '10'],
                ['enunciado' => 'Moda de 3,3,4,4,4,5', 'respuesta' => '4'],
                ['enunciado' => 'Mediana de 1,3,5,7', 'respuesta' => '4'],
                ['enunciado' => 'Media de 10,20,30', 'respuesta' => '20'],
                ['enunciado' => 'Moda de 2,2,3,3,3,4', 'respuesta' => '3'],
                ['enunciado' => 'Mediana de 6,7,8', 'respuesta' => '7']
            ]
        ]
    ]

];


        // Inserción en DB
        foreach ($actividadesPorUnidad as $gradoNum => $acts) {
            foreach ($acts as $actData) {
                $indicador = $indicadoresModels[$gradoNum][$actData['unidad']];
                $actividad = Actividad::create([
                    'indicador_id' => $indicador->id,
                    'titulo' => $actData['titulo'],
                    'objetivo' => $actData['objetivo'],
                    'tipo' => 'practica',
                    'accesibilidad_flags' => json_encode(['tts' => true, 'isn' => true]),
                    'dificultad_min' => 1,
                    'dificultad_max' => 3,
                    'orden' => 1
                ]);

                foreach ($actData['items'] as $idx => $itemData) {
                    Item::create([
                        'actividad_id' => $actividad->id,
                        'enunciado' => $itemData['enunciado'],
                        'datos' => null,
                        'respuesta' => $itemData['respuesta'],
                        'retro' => null,
                        'orden' => $idx + 1
                    ]);
                }
            }
        }
    }
}
