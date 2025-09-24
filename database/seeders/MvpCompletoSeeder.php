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
            'municipio' => 'Managua',
            'departamento' => 'Managua',
            'codigo_mined' => 'ESPERANZA-001',
            'tipo' => 'Pública',
            'anio_fundacion' => 2005,
            'director' => 'Juan Pérez'
        ]);

        // 2️⃣ Crear Roles
        foreach (['Docente','Estudiante','Tutor'] as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }

        // 3️⃣ Crear Grados
        $gradosData = [
            1 => ['nombre'=>'1º','descripcion'=>'Primer grado de primaria'],
            2 => ['nombre'=>'2º','descripcion'=>'Segundo grado de primaria'],
            3 => ['nombre'=>'3º','descripcion'=>'Tercer grado de primaria'],
            4 => ['nombre'=>'4º','descripcion'=>'Cuarto grado de primaria'],
            5 => ['nombre'=>'5º','descripcion'=>'Quinto grado de primaria'],
            6 => ['nombre'=>'6º','descripcion'=>'Sexto grado de primaria'],

        ];

        $grados = [];
        foreach($gradosData as $num => $data){
            $grados[$num] = Grado::create([
                'nombre'=>$data['nombre'],
                'descripcion'=>$data['descripcion'],
                'orden'=>$num
            ]);
        }

        // 4️⃣ Crear Docente y asignarle grados
        $docente = User::create([
            'name' => 'Alejandro Pérez',
            'username' => 'alejandro',
            'email' => 'alejandro@escuela.edu.ni',
            'password' => bcrypt('12345'),
            'escuela_id' => $escuela->id
        ]);
        $docente->assignRole('Docente');
        foreach ($grados as $grado) {
            $docente->grados()->attach($grado->id);
        }

        // 5️⃣ Crear Estudiantes y Matrículas, y asignarlos a los grados
      /*  $estudiantesData = [
            ['name'=>'Luis Gómez','username'=>'luis','email'=>'luis@escuela.edu.ni','grado'=>1,'seccion'=>'A','accesibilidad'=>[]],
            ['name'=>'Roberto Casco','username'=>'roberto','email'=>'roberto@escuela.edu.ni','grado'=>2,'seccion'=>'A','accesibilidad'=>[]],
            ['name'=>'Patricia Pérez','username'=>'patricia','email'=>'patricia@escuela.edu.ni','grado'=>2,'seccion'=>'A','accesibilidad'=>['tts'=>true]],
            ['name'=>'Pedro López','username'=>'pedro','email'=>'pedro@escuela.edu.ni','grado'=>3,'seccion'=>'B','accesibilidad'=>[]],
        ];  */


         $estudiantesData = [
            ['name'=>'Estudiante 1','username'=>'estudiante1','email'=>'estudiante1@escuela.edu.ni','grado'=>1,'seccion'=>'A','accesibilidad'=>[ 'tts'=>true]],
            ['name'=>'Estudiante 2','username'=>'estudiante2','email'=>'estudiante2@escuela.edu.ni','grado'=>2,'seccion'=>'A','accesibilidad'=>[]],
            ['name'=>'Estudiante 3','username'=>'estudiante3','email'=>'estudiante3@escuela.edu.ni','grado'=>3,'seccion'=>'A','accesibilidad'=>['tts'=>true]],
            ['name'=>'Estudiante 4','username'=>'estudiante4','email'=>'estudiante4@escuela.edu.ni','grado'=>4,'seccion'=>'B','accesibilidad'=>[]],
            ['name'=>'Estudiante 5','username'=>'estudiante5','email'=>'estudiante5@escuela.edu.ni','grado'=>5,'seccion'=>'B','accesibilidad'=>['tts'=>true]],
            ['name'=>'Estudiante 6','username'=>'estudiante6','email'=>'estudiante6@escuela.edu.ni','grado'=>6,'seccion'=>'B','accesibilidad'=>[]],
            ['name'=>'Estudiante 7','username'=>'estudiante7','email'=>'estudiante7@escuela.edu.ni','grado'=>6,'seccion'=>'B','accesibilidad'=>[]],
            ['name'=>'Estudiante 8','username'=>'estudiante8','email'=>'estudiante8@escuela.edu.ni','grado'=>6,'seccion'=>'B','accesibilidad'=>[]],
            ['name'=>'Estudiante 9','username'=>'estudiante9','email'=>'estudiante9@escuela.edu.ni','grado'=>6,'seccion'=>'B','accesibilidad'=>[]],
            ['name'=>'Estudiante 10','username'=>'estudiante10','email'=>'estudiante10@escuela.edu.ni','grado'=>6,'seccion'=>'B','accesibilidad'=>[]]
        ];

        foreach($estudiantesData as $estData) {
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
      
         // Comentado para evitar duplicados al correr varias veces

        
        // 6️⃣ Crear Unidades, Competencias e Indicadores
        $unidadesCompetenciasIndicadores = [
            1 => [
                ['unidad'=>'Unidad 1: Números hasta 20','descripcion'=>'Contar, sumar y restar hasta 20',
                    'competencias'=>[
                        ['titulo'=>'Contar y escribir números', 'indicadores'=>['Escribe los números 1-20','Cuenta objetos','Ordena números']],
                        ['titulo'=>'Sumar números pequeños', 'indicadores'=>['Suma dentro del 20','Representa sumas','Verifica resultados']],
                        ['titulo'=>'Resolver problemas sencillos', 'indicadores'=>['Problemas suma/resta','Identifica operación','Comprueba respuestas']]
                    ]
                ],
                ['unidad'=>'Unidad 2: Formas y patrones','descripcion'=>'Identificar formas geométricas y patrones',
                    'competencias'=>[
                        ['titulo'=>'Reconocer formas', 'indicadores'=>['Identifica círculos, cuadrados y triángulos','Clasifica formas','Dibuja formas']],
                        ['titulo'=>'Patrones simples', 'indicadores'=>['Completa patrones','Crea patrones','Explica patrón']],
                        ['titulo'=>'Medición básica', 'indicadores'=>['Usa regla','Compara tamaños','Ordena objetos']]
                    ]
                ]
            ],
            2 => [
                ['unidad'=>'Unidad 1: Números hasta 100','descripcion'=>'Sumar y restar hasta 100',
                    'competencias'=>[
                        ['titulo'=>'Comprender números', 'indicadores'=>['Lee y escribe números 1-100','Identifica decenas/unidades','Compara números']],
                        ['titulo'=>'Suma y resta', 'indicadores'=>['Resuelve sumas/restas hasta 100','Usa estrategias','Verifica resultados']],
                        ['titulo'=>'Aplicaciones cotidianas', 'indicadores'=>['Problemas de compras','Registro de operaciones','Explica soluciones']]
                    ]
                ],
                ['unidad'=>'Unidad 2: Tiempo y dinero','descripcion'=>'Lectura del reloj y manejo de dinero',
                    'competencias'=>[
                        ['titulo'=>'Lectura de reloj', 'indicadores'=>['Lee horas completas','Diferencia AM/PM','Resuelve problemas de tiempo']],
                        ['titulo'=>'Dinero', 'indicadores'=>['Suma y resta de dinero','Realiza compras','Calcula cambio']],
                        ['titulo'=>'Planificación', 'indicadores'=>['Organiza actividades','Usa calendario','Cuenta días/semanas']]
                    ]
                ]
            ],
            3 => [
                ['unidad'=>'Unidad 1: Multiplicación y división','descripcion'=>'Multiplicar y dividir números 1-2 cifras',
                    'competencias'=>[
                        ['titulo'=>'Multiplicación como suma repetida', 'indicadores'=>['Representa multiplicaciones','Resuelve multiplicaciones','Explica relación con suma']],
                        ['titulo'=>'Aplicar división', 'indicadores'=>['Divide cantidades iguales','Resuelve reparto','Relaciona división y multiplicación']],
                        ['titulo'=>'Problemas combinados', 'indicadores'=>['Resuelve mult/div','Identifica operación','Comprueba resultados']]
                    ]
                ],
                ['unidad'=>'Unidad 2: Medición y geometría','descripcion'=>'Medir, dibujar y calcular perímetro',
                    'competencias'=>[
                        ['titulo'=>'Medición', 'indicadores'=>['Mide longitud','Compara medidas','Ordena objetos']],
                        ['titulo'=>'Geometría', 'indicadores'=>['Dibuja figuras','Calcula perímetro','Reconoce figuras 2D']],
                        ['titulo'=>'Problemas prácticos', 'indicadores'=>['Resuelve problemas de perímetro','Aplica medición','Explica resultados']]
                    ]
                ]
            ]
        ];

        $indicadoresModels = [];

        foreach($unidadesCompetenciasIndicadores as $gradoNum => $unidades){
            foreach($unidades as $uniIdx => $uniData){
                $unidad = Unidad::create([
                    'grado_id'=>$grados[$gradoNum]->id,
                    'docente_id'=>$docente->id,
                    'titulo'=>$uniData['unidad'],
                    'descripcion'=>$uniData['descripcion'],
                    'orden'=>$uniIdx+1
                ]);

                foreach($uniData['competencias'] as $compIdx => $compData){
                    $comp = Competencia::create([
                        'unidad_id'=>$unidad->id,
                        'titulo'=>$compData['titulo'],
                        'descripcion'=>null,
                        'orden'=>$compIdx+1
                    ]);

                    foreach($compData['indicadores'] as $indIdx => $indTitulo){
                        $indicadoresModels[$gradoNum][$uniIdx][$compIdx][$indIdx] = Indicador::create([
                            'competencia_id'=>$comp->id,
                            'titulo'=>$indTitulo,
                            'descripcion'=>'Aplicación práctica del indicador',
                            'orden'=>$indIdx+1
                        ]);
                    }
                }
            }
        }

        // 7️⃣ Crear actividades + ítems
        $actividadesEjemplo = [
            1 => [
                ['indicador'=>0,'titulo'=>'Contar frutas','objetivo'=>'Contar y escribir la cantidad de frutas','items'=>['Cuenta 5 manzanas','Cuenta 3 naranjas','Cuenta 4 plátanos']],
                ['indicador'=>1,'titulo'=>'Sumar lápices','objetivo'=>'Sumar objetos pequeños','items'=>['3 lápices + 2 lápices','4 cuadernos + 1 cuaderno','2 borradores + 3 borradores']]
            ],
            2 => [
                ['indicador'=>0,'titulo'=>'Compras en la tienda','objetivo'=>'Resolver sumas y restas usando dinero','items'=>['Compra 3 lápices a C$5 cada uno y 2 cuadernos a C$10. ¿Cuánto pagas?','Pagas C$50 por 4 manzanas a C$8. ¿Cambio?','Pedro tiene C$100 y compra 5 bolígrafos a C$12. ¿Cuánto le sobra?']]
            ],
            3 => [
                ['indicador'=>0,'titulo'=>'Mercadito','objetivo'=>'Multiplicaciones y divisiones','items'=>['Compra 4 paquetes de galletas a C$7 cada uno. ¿Cuánto pagas?','18 naranjas repartidas entre 3 amigos, ¿cuántas recibe cada uno?','3 cajas de lápices con 12 lápices cada una, ¿cuántos lápices en total?']]
            ]
        ];

        foreach($actividadesEjemplo as $gradoNum => $acts){
            foreach($acts as $actData){
                $indicador = $indicadoresModels[$gradoNum][0][$actData['indicador']][0];
                $actividad = Actividad::create([
                    'indicador_id'=>$indicador->id,
                    'titulo'=>$actData['titulo'],
                    'objetivo'=>$actData['objetivo'],
                    'tipo'=>'practica',
                    'accesibilidad_flags'=>json_encode(['tts'=>true,'isn'=>true]),
                    'dificultad_min'=>1,
                    'dificultad_max'=>3,
                    'orden'=>1
                ]);

                foreach($actData['items'] as $idx => $enunciado){
                    Item::create([
                        'actividad_id'=>$actividad->id,
                        'enunciado'=>$enunciado,
                        'datos'=>null,
                        'respuesta'=>null,
                        'retro'=>null,
                        'orden'=>$idx+1
                    ]);
                }
            }
        }
        
    }
}
