<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederJuegosBloqueadosNivel3 extends Seeder
{
    public function run(): void
    {
        // 🔒 Juegos bloqueados de nivel 3 - Operaciones Básicas
        $juegosBloqueados = [
            ["Suma Avanzada Reto", "fa-plus", "Refuerza tus habilidades en sumas complejas.", "Operaciones Básicas"],
            ["Resta Avanzada Reto", "fa-minus", "Resuelve restas de varios dígitos.", "Operaciones Básicas"],
            ["Multiplicación Avanzada Reto", "fa-xmark", "Practica multiplicaciones grandes.", "Operaciones Básicas"],
            ["División Avanzada Reto", "fa-divide", "Domina divisiones con residuo.", "Operaciones Básicas"],
        ];

        foreach ($juegosBloqueados as $j) {
            $juego = Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'categoria' => $j[3],
                'puntos_base' => 20,
                'tipo' => 'quiz',
                'bloqueado' => true,
                'requisito_puntos' => 100,
                'requisito_monedas' => 50,
                'nivel' => 3,
            ]);

            // 🧮 Preguntas según el juego
            $preguntas = [];

            switch ($j[0]) {
                case "Suma Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 25 + 37?", ["61","62","63","64"], "62"],
                        ["¿Cuánto es 48 + 15?", ["62","68","63","65"], "63"],
                        ["¿Cuánto es 33 + 28?", ["60","69","62","61"], "61"],
                        ["¿Cuánto es 17 + 29?", ["46","49","47","48"], "46"],
                        ["¿Cuánto es 56 + 23?", ["78","79","80","81"], "79"],
                        ["¿Cuánto es 34 + 41?", ["74","75","76","77"], "75"],
                        ["¿Cuánto es 22 + 38?", ["59","60","61","62"], "60"],
                        ["¿Cuánto es 19 + 47?", ["65","66","67","68"], "66"],
                        ["¿Cuánto es 28 + 36?", ["63","64","65","66"], "64"],
                        ["¿Cuánto es 15 + 49?", ["63","64","65","66"], "64"],
                    ];
                    break;

                case "Resta Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 75 - 28?", ["46","47","48","49"], "47"],
                        ["¿Cuánto es 94 - 57?", ["36","37","38","39"], "37"],
                        ["¿Cuánto es 63 - 29?", ["33","34","35","36"], "34"],
                        ["¿Cuánto es 81 - 45?", ["35","36","37","38"], "36"],
                        ["¿Cuánto es 70 - 18?", ["51","52","53","54"], "52"],
                    ];
                    break;

                case "Multiplicación Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 8 × 7?", ["54","55","56","57"], "56"],
                        ["¿Cuánto es 9 × 6?", ["52","53","54","55"], "54"],
                        ["¿Cuánto es 12 × 3?", ["35","36","37","38"], "36"],
                        ["¿Cuánto es 15 × 5?", ["74","75","76","77"], "75"],
                        ["¿Cuánto es 13 × 4?", ["51","52","53","54"], "52"],
                    ];
                    break;

                case "División Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 56 ÷ 8?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 45 ÷ 9?", ["4","5","6","7"], "5"],
                        ["¿Cuánto es 72 ÷ 6?", ["11","12","13","14"], "12"],
                        ["¿Cuánto es 64 ÷ 4?", ["15","16","17","18"], "16"],
                        ["¿Cuánto es 81 ÷ 9?", ["8","9","10","11"], "9"],
                    ];
                    break;
            }

            // 💾 Guardar preguntas
            foreach ($preguntas as $p) {
                Pregunta::create([
                    'juego_id' => $juego->id,
                    'enunciado' => $p[0],
                    'opciones' => json_encode($p[1]),
                    'respuesta_correcta' => $p[2],
                ]);
            }
        }
    }
}
