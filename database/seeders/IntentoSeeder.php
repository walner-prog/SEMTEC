<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use App\Models\Intento;

class IntentoSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = User::role('Estudiante')->get();

        if ($estudiantes->isEmpty()) {
            $this->command->error("No hay estudiantes en la base de datos");
            return;
        }

        $items = Item::all();
        if ($items->isEmpty()) {
            $this->command->error("No hay ítems en la base de datos");
            return;
        }

        foreach ($estudiantes as $estudiante) {
            foreach ($items as $item) {
                // Generar entre 1 y 3 intentos por ítem
                $numIntentos = rand(1, 1);
                for ($i = 0; $i < $numIntentos; $i++) {
                    Intento::create([
                        'actividad_id' => $item->actividad_id,
                        'item_id'      => $item->id,
                        'user_id'      => $estudiante->id,
                        'inicio'       => now()->subMinutes(rand(10, 120)),
                        'fin'          => now(),
                        'aciertos'     => rand(0, 1),
                        'errores'      => rand(0, 1),
                        'tiempo_seg'   => rand(30, 180),
                        'ayuda_usada'  => json_encode(['hint' => rand(0, 1) == 1]),
                        'puntaje'      => rand(0, 100)
                    ]);
                }
            }
            $this->command->info("Se han creado intentos de prueba para {$estudiante->name}");
        }

        $this->command->info("Seeder de intentos completado correctamente");
    }
}
