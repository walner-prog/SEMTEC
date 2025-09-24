<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grado;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\Actividad;
use App\Models\Item;

class MvpSeeder extends Seeder
{
    public function run(): void
    {

        /*
        Secuencia de creación de datos para el MVP:
        1️⃣ Crear Grados (2º y 3º de primaria)
        2️⃣ Crear Unidades de ejemplo para cada grado
        3️⃣ Crear 3 Competencias por Unidad
        4️⃣ Crear Indicadores por Competencia
        5️⃣ Crear Actividad “Mercadito” para grado 2
        6️⃣ Crear 3 Ítems de la actividad
        
        
        */
        // ------------------------------
        // 1️⃣ Crear Grados
        // ------------------------------
        $grado2 = Grado::create([
            'nombre' => '2º',
            'descripcion' => 'Segundo grado de primaria',
            'orden' => 2
        ]);

        $grado3 = Grado::create([
            'nombre' => '3º',
            'descripcion' => 'Tercer grado de primaria',
            'orden' => 3
        ]);

        // ------------------------------
        // 2️⃣ Crear Unidades de ejemplo
        // ------------------------------
        $unidad2 = Unidad::create([
            'grado_id' => $grado2->id,
            'titulo' => 'Unidad 1: Números y operaciones',
            'descripcion' => 'Aprendemos a sumar y restar números hasta 100',
            'orden' => 1
        ]);

        $unidad3 = Unidad::create([
            'grado_id' => $grado3->id,
            'titulo' => 'Unidad 1: Multiplicación y división',
            'descripcion' => 'Aprendemos multiplicar y dividir números de 1 y 2 cifras',
            'orden' => 1
        ]);

        // ------------------------------
        // 3️⃣ Crear 3 Competencias por Unidad
        // ------------------------------
        $competencias2 = [
            'Comprende y utiliza los números naturales hasta 100',
            'Resuelve problemas de suma y resta',
            'Relaciona operaciones con situaciones de la vida diaria'
        ];

        foreach ($competencias2 as $index => $titulo) {
            Competencia::create([
                'unidad_id' => $unidad2->id,
                'titulo' => $titulo,
                'descripcion' => null,
                'orden' => $index + 1
            ]);
        }

        $competencias3 = [
            'Comprende la multiplicación como suma repetida',
            'Aplica la división en problemas cotidianos',
            'Relaciona multiplicación y división'
        ];

        foreach ($competencias3 as $index => $titulo) {
            Competencia::create([
                'unidad_id' => $unidad3->id,
                'titulo' => $titulo,
                'descripcion' => null,
                'orden' => $index + 1
            ]);
        }

        // ------------------------------
        // 4️⃣ Crear Indicadores por Competencia
        // ------------------------------
        $competencias2_ids = Competencia::where('unidad_id', $unidad2->id)->pluck('id');
        foreach ($competencias2_ids as $competencia_id) {
            Indicador::create([
                'competencia_id' => $competencia_id,
                'titulo' => 'Indicador ejemplo para competencia ' . $competencia_id,
                'descripcion' => 'Aplica correctamente la competencia en ejercicios prácticos',
                'orden' => 1
            ]);
        }

        $competencias3_ids = Competencia::where('unidad_id', $unidad3->id)->pluck('id');
        foreach ($competencias3_ids as $competencia_id) {
            Indicador::create([
                'competencia_id' => $competencia_id,
                'titulo' => 'Indicador ejemplo para competencia ' . $competencia_id,
                'descripcion' => 'Resuelve problemas que integren multiplicación y división',
                'orden' => 1
            ]);
        }

        // ------------------------------
        // 5️⃣ Crear Actividad “Mercadito” para grado 2
        // ------------------------------
        $indicador2 = Indicador::whereHas('competencia', fn($q) => $q->where('unidad_id',$unidad2->id))->first();

        $actividad = Actividad::create([
            'indicador_id' => $indicador2->id,
            'titulo' => 'Mercadito',
            'objetivo' => 'Resolver compras exactas usando descomposición de números',
            'tipo' => 'practica',
            'accesibilidad_flags' => json_encode(['tts'=>true,'isn'=>true]),
            'dificultad_min'=>1,
            'dificultad_max'=>3,
            'orden'=>1
        ]);

        // ------------------------------
        // 6️⃣ Crear 3 Ítems de la actividad
        // ------------------------------
        $items = [
            "Compra pan (C$35) y leche (C$28). Pagas con C$100. ¿Cuánto cambio recibes?",
            "Compra 3 manzanas a C$10 cada una. Pagas con C$50. ¿Cuánto te sobra?",
            "Compra 2 refrescos a C$12 cada uno. Pagas con C$30. ¿Cuánto cambio recibes?"
        ];

        foreach ($items as $index => $enunciado) {
            Item::create([
                'actividad_id' => $actividad->id,
                'enunciado' => $enunciado,
                'datos' => null,
                'respuesta' => null,
                'retro' => null,
                'orden' => $index + 1
            ]);
        }
    }
}
