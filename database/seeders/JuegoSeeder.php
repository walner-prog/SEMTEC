<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;

class JuegoSeeder extends Seeder
{
    public function run(): void
    {
        $juegosDisponibles = [
            ["Suma y Resta", "fa-plus-minus", "Pon a prueba tu rapidez con operaciones básicas.", "Operaciones Básicas"],
            ["Problemas Matemáticos", "fa-brain", "Resuelve retos y mejora tu razonamiento lógico.", "Razonamiento"],
            ["Multiplicaciones", "fa-xmark", "Domina las tablas y mejora tu velocidad.", "Operaciones Básicas"],
            ["Divisiones", "fa-divide", "Desafía tu precisión con divisiones rápidas.", "Operaciones Básicas"],
            ["Fracciones", "fa-pie-chart", "Aprende a sumar, restar y comparar fracciones.", "Números y Fracciones"],
            ["Secuencias Numéricas", "fa-list-ol", "Identifica patrones y completa la secuencia.", "Razonamiento"],
            ["Geometría", "fa-shapes", "Reconoce figuras y calcula áreas y perímetros.", "Geometría"],
            ["Medidas y Unidades", "fa-ruler-combined", "Convierte y compara longitudes y pesos.", "Magnitudes y Medidas"],
            ["Razonamiento Lógico", "fa-puzzle-piece", "Ejercita tu mente con acertijos y puzzles.", "Razonamiento"],
            ["Velocidad Mental", "fa-bolt", "Responde operaciones contra el reloj.", "Operaciones Básicas"],
            ["Matemagia", "fa-wand-magic-sparkles", "Combina números para alcanzar un objetivo.", "Razonamiento"],
            ["Quiz de Matemáticas", "fa-question", "Demuestra lo aprendido en un quiz divertido.", "General"],
        ];

        foreach ($juegosDisponibles as $j) {
            Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'categoria' => $j[3],
                'puntos_base' => 10,
                'tipo' => 'quiz',
                'bloqueado' => false,
                'nivel' => match($j[0]) {
                    "Suma y Resta", "Problemas Matemáticos" => 5,
                    "Multiplicaciones", "Divisiones" => 5,
                    "Fracciones", "Secuencias Numéricas" => 5,
                    "Geometría", "Medidas y Unidades" => 6,
                    "Razonamiento Lógico", "Velocidad Mental" => 6,
                    "Matemagia", "Quiz de Matemáticas" => 5,
                    default => 1,
                }
            ]);
        }

        // 🔒 Juegos bloqueados
        $juegosBloqueados = [
            ["Álgebra", "fa-square-root-variable", "Resuelve ecuaciones y expresiones algebraicas.", "Álgebra"],
            ["Estadística", "fa-chart-column", "Interpreta y analiza datos numéricos.", "Estadística y Datos"],
            ["Porcentajes", "fa-percent", "Domina descuentos, aumentos y proporciones.", "Porcentajes y Proporciones"],
            ["Tiempo y Relojes", "fa-clock", "Calcula horas, minutos y segundos.", "Magnitudes y Medidas"],
            ["Medidas Avanzadas", "fa-weight-scale", "Trabaja con volumen y capacidad.", "Magnitudes y Medidas"],
            ["Probabilidad", "fa-dice", "Calcula la probabilidad de diferentes eventos.", "Estadística y Datos"],
        ];

        foreach ($juegosBloqueados as $j) {
            Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'categoria' => $j[3],
                'puntos_base' => 20,
                'tipo' => 'quiz',
                'bloqueado' => true,
                'requisito_puntos' => 100,
                'requisito_monedas' => 50,
                'nivel' => match($j[0]) {
                    "Álgebra", "Estadística" => 6,
                    "Porcentajes", "Tiempo y Relojes" => 6,
                    "Medidas Avanzadas", "Probabilidad" => 6,
                    default => 1,
                }
            ]);
        }
    }
}
