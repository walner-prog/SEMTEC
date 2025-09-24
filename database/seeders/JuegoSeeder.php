<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;

class JuegoSeeder extends Seeder
{
    public function run(): void
    {
        $juegosDisponibles = [
            ["Suma y Resta", "fa-plus-minus", "Pon a prueba tu rapidez con operaciones básicas."],
            ["Problemas Matemáticos", "fa-brain", "Resuelve retos y mejora tu razonamiento lógico."],
            ["Multiplicaciones", "fa-xmark", "Domina las tablas y mejora tu velocidad."],
            ["Divisiones", "fa-divide", "Desafía tu precisión con divisiones rápidas."],
            ["Fracciones", "fa-pie-chart", "Aprende a sumar, restar y comparar fracciones."],
            ["Secuencias Numéricas", "fa-list-ol", "Identifica patrones y completa la secuencia."],
            ["Geometría", "fa-shapes", "Reconoce figuras y calcula áreas y perímetros."],
            ["Medidas y Unidades", "fa-ruler-combined", "Convierte y compara longitudes y pesos."],
            ["Razonamiento Lógico", "fa-puzzle-piece", "Ejercita tu mente con acertijos y puzzles."],
            ["Velocidad Mental", "fa-bolt", "Responde operaciones contra el reloj."],
            ["Matemagia", "fa-wand-magic-sparkles", "Combina números para alcanzar un objetivo."],
            ["Quiz de Matemáticas", "fa-question", "Demuestra lo aprendido en un quiz divertido."],
        ];

       foreach ($juegosDisponibles as $j) {
    Juego::create([
        'nombre' => $j[0],
        'icono' => $j[1],
        'descripcion' => $j[2],
        'puntos_base' => 10,
        'tipo' => 'quiz',
        'bloqueado' => false,
        'nivel' => match($j[0]) {
            "Suma y Resta", "Problemas Matemáticos" => 5, // quinto grado
            "Multiplicaciones", "Divisiones" => 5,        // quinto grado
            "Fracciones", "Secuencias Numéricas" => 5,    // quinto grado
            "Geometría", "Medidas y Unidades" => 6,       // sexto grado
            "Razonamiento Lógico", "Velocidad Mental" => 6,// sexto grado
            "Matemagia", "Quiz de Matemáticas" => 5,      // quinto grado
            default => 1,
        }
    ]);
}


        $juegosBloqueados = [
            ["Álgebra", "fa-square-root-variable", "Resuelve ecuaciones y expresiones algebraicas."],
            ["Estadística", "fa-chart-column", "Interpreta y analiza datos numéricos."],
            ["Porcentajes", "fa-percent", "Domina descuentos, aumentos y proporciones."],
            ["Tiempo y Relojes", "fa-clock", "Calcula horas, minutos y segundos."],
            ["Medidas Avanzadas", "fa-weight-scale", "Trabaja con volumen y capacidad."],
            ["Probabilidad", "fa-dice", "Calcula la probabilidad de diferentes eventos."],
        ];

       foreach ($juegosBloqueados as $j) {
    Juego::create([
        'nombre' => $j[0],
        'icono' => $j[1],
        'descripcion' => $j[2],
        'puntos_base' => 20,
        'tipo' => 'quiz',
        'bloqueado' => true,
        'requisito_puntos' => 100,
        'requisito_monedas' => 50,
        'nivel' => match($j[0]) {
            "Álgebra", "Estadística" => 6,   // Sexto grado
            "Porcentajes", "Tiempo y Relojes" => 6,// Sexto grado
            "Medidas Avanzadas", "Probabilidad" => 6,
            default => 1,
        }
    ]);
}

    }
}
