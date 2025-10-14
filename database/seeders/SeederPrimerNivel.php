<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederPrimerNivel extends Seeder
{
    public function run(): void
    {
        $juegosPrimerGrado = [
            ["Suma Básica", "fa-plus", "Aprende a sumar números pequeños.", 1, "Matemáticas"],
            ["Resta Básica", "fa-minus", "Aprende a restar números pequeños.", 1, "Matemáticas"],
            ["Contar Objetos", "fa-list-ol", "Reconoce y cuenta objetos simples.", 1, "Matemáticas"],
            ["Formas y Figuras", "fa-shapes", "Identifica figuras geométricas básicas.", 1, "Matemáticas"],
            ["Colores", "fa-paint-brush", "Reconoce y nombra colores básicos.", 1, "Arte/Colores"],
            ["Animales", "fa-dog", "Identifica animales comunes.", 1, "Ciencias/Naturaleza"]
        ];

        // Crear juegos
        foreach ($juegosPrimerGrado as $j) {
            $juego = Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'puntos_base' => 5,
                'tipo' => 'quiz',
                'bloqueado' => false,
                'nivel' => $j[3],
                'categoria' => $j[4], // ← agregamos categoría
            ]);

            // Crear preguntas según juego
            $preguntas = [];

            switch ($j[0]) {
                case "Suma Básica":
                    $preguntas = [
                        ["¿Cuánto es 1 + 1?", ["1", "2", "3", "4"], "2"],
                        ["¿Cuánto es 2 + 2?", ["2", "3", "4", "5"], "4"],
                        ["¿Cuánto es 3 + 1?", ["3", "4", "5", "6"], "4"],
                        ["¿Cuánto es 0 + 5?", ["4", "5", "6", "7"], "5"],
                        ["¿Cuánto es 2 + 3?", ["4", "5", "6", "7"], "5"],
                    ];
                    break;

                case "Resta Básica":
                    $preguntas = [
                        ["¿Cuánto es 2 - 1?", ["0", "1", "2", "3"], "1"],
                        ["¿Cuánto es 5 - 2?", ["2", "3", "4", "5"], "3"],
                        ["¿Cuánto es 3 - 0?", ["2", "3", "4", "5"], "3"],
                        ["¿Cuánto es 4 - 2?", ["1", "2", "3", "4"], "2"],
                        ["¿Cuánto es 5 - 5?", ["0", "1", "2", "3"], "0"],
                    ];
                    break;

                case "Contar Objetos":
                    $preguntas = [
                        ["¿Cuántos manzanas hay? 🍎🍎🍎", ["2", "3", "4", "5"], "3"],
                        ["¿Cuántos gatos hay? 🐱🐱", ["1", "2", "3", "4"], "2"],
                        ["¿Cuántos soles hay? ☀️☀️☀️☀️", ["3", "4", "5", "6"], "4"],
                        ["¿Cuántos árboles hay? 🌳🌳🌳🌳🌳", ["4", "5", "6", "7"], "5"],
                        ["¿Cuántos peces hay? 🐟🐟🐟", ["2", "3", "4", "5"], "3"],
                    ];
                    break;

                case "Formas y Figuras":
                    $preguntas = [
                        ["¿Cuál es un círculo?", ["⬛", "🔺", "⚪", "⬜"], "⚪"],
                        ["¿Cuál es un triángulo?", ["🔺", "⬛", "⚪", "⬜"], "🔺"],
                        ["¿Cuál es un cuadrado?", ["⬛", "🔺", "⚪", "⬜"], "⬛"],
                        ["¿Cuál tiene 3 lados?", ["⚪", "🔺", "⬛", "⬜"], "🔺"],
                        ["¿Cuál tiene 4 lados?", ["⚪", "🔺", "⬛", "⬜"], "⬛"],
                    ];
                    break;

                case "Colores":
                    $preguntas = [
                        ["¿De qué color es el cielo?", ["Rojo", "Azul", "Verde", "Amarillo"], "Azul"],
                        ["¿De qué color es una manzana?", ["Azul", "Verde", "Rojo", "Amarillo"], "Rojo"],
                        ["¿De qué color es el pasto?", ["Rojo", "Azul", "Verde", "Amarillo"], "Verde"],
                        ["¿De qué color es el sol?", ["Rojo", "Azul", "Verde", "Amarillo"], "Amarillo"],
                        ["¿De qué color es una naranja?", ["Naranja", "Azul", "Verde", "Rojo"], "Naranja"],
                    ];
                    break;

                case "Animales":
                    $preguntas = [
                        ["¿Cuál es un perro?", ["🐶", "🐱", "🐰", "🐹"], "🐶"],
                        ["¿Cuál es un gato?", ["🐶", "🐱", "🐰", "🐹"], "🐱"],
                        ["¿Cuál es un conejo?", ["🐶", "🐱", "🐰", "🐹"], "🐰"],
                        ["¿Cuál es un hámster?", ["🐶", "🐱", "🐰", "🐹"], "🐹"],
                    ];
                    break;
            }

            // Guardar preguntas
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
