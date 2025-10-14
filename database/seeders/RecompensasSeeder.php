<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recompensa;

class RecompensasSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['clave' => 'estrella_dorada', 'tipo' => 'Estrella Dorada', 'icono_url' => null, 'descripcion' => 'Reconocimiento por completar 5 actividades', 'puntos_requeridos' => 50],
            ['clave' => 'medalla_esfuerzo', 'tipo' => 'Medalla de Esfuerzo', 'icono_url' => null, 'descripcion' => 'Por esfuerzo constante', 'puntos_requeridos' => 100],
            ['clave' => 'bono_extra', 'tipo' => 'Bonificación Extra', 'icono_url' => null, 'descripcion' => 'Bonificación para contenido adicional', 'puntos_requeridos' => 200],
        ];

        foreach ($items as $it) {
            Recompensa::updateOrCreate(['clave' => $it['clave']], $it);
        }
    }
}
