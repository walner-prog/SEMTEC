<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recompensa;

class RecompensaSeeder extends Seeder
{
    public function run(): void
    {
        $recompensas = [
            [
                'clave' => 'medalla_oro',
                'tipo' => 'medalla',
                'icono_url' => 'fa-solid fa-medal text-yellow-400',
                'descripcion' => 'Medalla de oro por superar un reto difícil',
                'puntos_requeridos' => 50
            ],
            [
                'clave' => 'medalla_plata',
                'tipo' => 'medalla',
                'icono_url' => 'fa-solid fa-medal text-gray-400',
                'descripcion' => 'Medalla de plata por completar un juego',
                'puntos_requeridos' => 30
            ],
            [
                'clave' => 'sticker_sonrisa',
                'tipo' => 'sticker',
                'icono_url' => 'fa-solid fa-face-smile text-pink-500',
                'descripcion' => 'Sticker de sonrisa por buen desempeño',
                'puntos_requeridos' => 10
            ],
            [
                'clave' => 'marco_magico',
                'tipo' => 'marco',
                'icono_url' => 'fa-solid fa-star text-purple-500',
                'descripcion' => 'Marco especial para tu perfil',
                'puntos_requeridos' => 70
            ],
        ];

        foreach ($recompensas as $r) {
            Recompensa::updateOrCreate(
                ['clave' => $r['clave']],
                $r
            );
        }
    }
}
