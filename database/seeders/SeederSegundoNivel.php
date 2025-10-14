<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederSegundoNivel extends Seeder
{
    public function run(): void
    {
       $juegosSegundoGrado = [
            ["Suma Avanzada", "fa-plus", "Suma números de 1 a 20.", 2, "Matemáticas"],
            ["Resta Avanzada", "fa-minus", "Resta números de 1 a 20.", 2, "Matemáticas"],
            ["Multiplicación Básica", "fa-xmark", "Aprende las tablas del 2 y 3.", 2, "Matemáticas"],
            ["División Básica", "fa-divide", "Divide números pequeños.", 2, "Matemáticas"],
            ["Secuencias Numéricas", "fa-list-ol", "Completa las secuencias.", 2, "Matemáticas"],
            ["Figuras Geométricas", "fa-shapes", "Reconoce y dibuja figuras.", 2, "Geometría/Medidas"],
            ["Medidas Simples", "fa-ruler", "Aprende centímetros y metros.", 2, "Geometría/Medidas"],
            ["Problemas de Suma y Resta", "fa-brain", "Resuelve problemas cotidianos.", 2, "Razonamiento/Problemas"],
            ["Razonamiento Lógico", "fa-puzzle-piece", "Ejercita tu mente con acertijos.", 2, "Razonamiento/Problemas"],
            ["Comparación de Números", "fa-arrows-left-right", "Mayor, menor o igual.", 2, "Matemáticas"],
        ];

        foreach ($juegosSegundoGrado as $j) {
            $juego = Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'puntos_base' => 10,
                'tipo' => 'quiz',
                'bloqueado' => false,
                'nivel' => $j[3],
                'categoria' => $j[4], // ← agregamos categoría
            ]);

            // Preguntas por juego
            $preguntas = [];

            switch ($j[0]) {
                case "Suma Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 7 + 5?", ["10","11","12","13"], "12"],
                        ["¿Cuánto es 8 + 6?", ["13","14","15","16"], "14"],
                        ["¿Cuánto es 9 + 4?", ["12","13","14","15"], "13"],
                        ["¿Cuánto es 6 + 7?", ["12","13","14","15"], "13"],
                        ["¿Cuánto es 10 + 5?", ["14","15","16","17"], "15"],
                        ["¿Cuánto es 3 + 8?", ["10","11","12","13"], "11"],
                        ["¿Cuánto es 2 + 9?", ["10","11","12","13"], "11"],
                        ["¿Cuánto es 5 + 6?", ["10","11","12","13"], "11"],
                        ["¿Cuánto es 4 + 7?", ["10","11","12","13"], "11"],
                        ["¿Cuánto es 1 + 12?", ["12","13","14","15"], "13"],
                    ];
                    break;

                case "Resta Avanzada":
                    $preguntas = [
                        ["¿Cuánto es 12 - 5?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 15 - 8?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 14 - 6?", ["7","8","9","10"], "8"],
                        ["¿Cuánto es 13 - 4?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 10 - 3?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 9 - 5?", ["3","4","5","6"], "4"],
                        ["¿Cuánto es 8 - 2?", ["5","6","7","8"], "6"],
                        ["¿Cuánto es 7 - 1?", ["5","6","7","8"], "6"],
                        ["¿Cuánto es 6 - 3?", ["2","3","4","5"], "3"],
                        ["¿Cuánto es 5 - 2?", ["2","3","4","5"], "3"],
                    ];
                    break;

                case "Multiplicación Básica":
                    $preguntas = [
                        ["¿Cuánto es 2 × 3?", ["4","5","6","7"], "6"],
                        ["¿Cuánto es 3 × 2?", ["4","5","6","7"], "6"],
                        ["¿Cuánto es 2 × 5?", ["8","9","10","11"], "10"],
                        ["¿Cuánto es 3 × 3?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 2 × 4?", ["7","8","9","10"], "8"],
                        ["¿Cuánto es 3 × 4?", ["10","11","12","13"], "12"],
                        ["¿Cuánto es 2 × 6?", ["11","12","13","14"], "12"],
                        ["¿Cuánto es 3 × 5?", ["14","15","16","17"], "15"],
                        ["¿Cuánto es 2 × 7?", ["12","13","14","15"], "14"],
                        ["¿Cuánto es 3 × 6?", ["17","18","19","20"], "18"],
                    ];
                    break;

                case "División Básica":
                    $preguntas = [
                        ["¿Cuánto es 6 ÷ 2?", ["2","3","4","5"], "3"],
                        ["¿Cuánto es 8 ÷ 4?", ["1","2","3","4"], "2"],
                        ["¿Cuánto es 12 ÷ 3?", ["3","4","5","6"], "4"],
                        ["¿Cuánto es 10 ÷ 2?", ["4","5","6","7"], "5"],
                        ["¿Cuánto es 9 ÷ 3?", ["2","3","4","5"], "3"],
                        ["¿Cuánto es 14 ÷ 2?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 15 ÷ 3?", ["4","5","6","7"], "5"],
                        ["¿Cuánto es 16 ÷ 4?", ["3","4","5","6"], "4"],
                        ["¿Cuánto es 18 ÷ 3?", ["5","6","7","8"], "6"],
                        ["¿Cuánto es 20 ÷ 5?", ["3","4","5","6"], "4"],
                    ];
                    break;

                case "Secuencias Numéricas":
                    $preguntas = [
                        ["Completa: 2, 4, __, 8", ["5","6","7","9"], "6"],
                        ["Completa: 3, 6, __, 12", ["7","8","9","10"], "9"],
                        ["Completa: 5, 10, __, 20", ["12","13","14","15"], "15"],
                        ["Completa: 1, 3, __, 7", ["3","4","5","6"], "5"],
                        ["Completa: 4, 8, __, 16", ["10","11","12","13"], "12"],
                        ["Completa: 6, 12, __, 24", ["16","17","18","19"], "18"],
                        ["Completa: 7, 14, __, 28", ["20","21","22","23"], "21"],
                        ["Completa: 9, 18, __, 36", ["16","17","18","19"], "18"],
                        ["Completa: 10, 20, __, 40", ["18","19","20","21"], "20"],
                        ["Completa: 8, 16, __, 32", ["18","19","20","21"], "20"],
                    ];
                    break;

                case "Figuras Geométricas":
                    $preguntas = [
                        ["¿Cuál es un círculo?", ["⚪","🔺","⬛","⬜"], "⚪"],
                        ["¿Cuál es un triángulo?", ["⚪","🔺","⬛","⬜"], "🔺"],
                        ["¿Cuál es un cuadrado?", ["⚪","🔺","⬛","⬜"], "⬛"],
                        ["¿Cuál tiene 3 lados?", ["⚪","🔺","⬛","⬜"], "🔺"],
                        ["¿Cuál tiene 4 lados?", ["⚪","🔺","⬛","⬜"], "⬛"],
                        ["¿Cuál es un rectángulo?", ["⬛","⬜","🔺","⚪"], "⬜"],
                        ["¿Cuál es un pentágono?", ["⬛","⬜","🔺","⬟"], "⬟"],
                        ["¿Cuál es un hexágono?", ["⬛","⬜","⬟","⬢"], "⬢"],
                        ["¿Cuál tiene 5 lados?", ["⬛","⬜","⬟","⬢"], "⬟"],
                        ["¿Cuál tiene 6 lados?", ["⬛","⬜","⬟","⬢"], "⬢"],
                    ];
                    break;

                case "Medidas Simples":
                    $preguntas = [
                        ["¿Cuántos centímetros tiene un metro?", ["10","50","100","1000"], "100"],
                        ["¿Cuántos metros hay en 2 kilómetros?", ["1000","2000","3000","4000"], "2000"],
                        ["¿Cuánto pesa 1 kilogramo?", ["100g","500g","1000g","2000g"], "1000g"],
                        ["Si tienes 5 litros y tomas 2, ¿cuánto queda?", ["2","3","4","5"], "3"],
                        ["Si una caja tiene 12 manzanas y comes 5, ¿cuántas quedan?", ["6","7","8","9"], "7"],
                        ["¿Cuántos días tiene una semana?", ["5","6","7","8"], "7"],
                        ["¿Cuántos meses tiene un año?", ["10","11","12","13"], "12"],
                        ["¿Cuántos segundos tiene un minuto?", ["30","45","60","90"], "60"],
                        ["Si corro 2 km cada día, ¿cuánto corro en 3 días?", ["4","5","6","7"], "6"],
                        ["Si un litro de jugo cuesta 10 córdobas, ¿cuánto cuestan 3 litros?", ["20","25","30","35"], "30"],
                    ];
                    break;

                case "Problemas de Suma y Resta":
                    $preguntas = [
                        ["Juan tenía 5 manzanas y compra 3 más, ¿cuántas tiene?", ["7","8","9","10"], "8"],
                        ["María tenía 10 caramelos y regala 4, ¿cuántos le quedan?", ["5","6","7","8"], "6"],
                        ["En una granja hay 6 ovejas y nacen 2 más, ¿cuántas hay?", ["7","8","9","10"], "8"],
                        ["Pedro tenía 12 lápices y pierde 3, ¿cuántos le quedan?", ["8","9","10","11"], "9"],
                        ["Si tienes 7 globos y se revientan 2, ¿cuántos quedan?", ["4","5","6","7"], "5"],
                        ["Ana tenía 9 galletas y come 3, ¿cuántas quedan?", ["5","6","7","8"], "6"],
                        ["Luis tenía 15 monedas y gasta 5, ¿cuántas le quedan?", ["9","10","11","12"], "10"],
                        ["María tenía 8 lápices y recibe 4 más, ¿cuántos tiene?", ["11","12","13","14"], "12"],
                        ["Si en un salón hay 10 niños y entran 2 más, ¿cuántos hay?", ["11","12","13","14"], "12"],
                        ["Un niño tenía 6 juguetes y le regalan 3, ¿cuántos tiene?", ["8","9","10","11"], "9"],
                    ];
                    break;

                case "Razonamiento Lógico":
                    $preguntas = [
                        ["Si todos los gatos son animales y algunos animales son perros, ¿los gatos son perros?", ["Sí","No","A veces","Ninguno"], "No"],
                        ["Si hoy es lunes, ¿qué día será dentro de 2 días?", ["Martes","Miércoles","Jueves","Viernes"], "Miércoles"],
                        ["Pedro es más alto que Ana y Ana es más alta que Juan. ¿Quién es el más bajo?", ["Pedro","Ana","Juan","Ninguno"], "Juan"],
                        ["Si un número es par, ¿qué sucede al sumarle otro número par?", ["Sigue par","Se vuelve impar","Es cero","Ninguno"], "Sigue par"],
                        ["Si un gallo pone un huevo en el techo, ¿de qué lado caerá?", ["Derecha","Izquierda","No pone","Ambos"], "No pone"],
                        ["Si hoy es 31 de diciembre, ¿qué día será mañana?", ["1 de enero","30 de diciembre","2 de enero","Ninguno"], "1 de enero"],
                        ["En una fila hay 3 niños. Ana está delante de Luis y Luis delante de Juan. ¿Quién está primero?", ["Ana","Luis","Juan","Ninguno"], "Ana"],
                        ["Si tienes 2 pelotas y compras 3 más, ¿cuántas tienes?", ["4","5","6","7"], "5"],
                        ["Si un perro tiene 4 patas y hay 3 perros, ¿cuántas patas hay?", ["10","11","12","13"], "12"],
                        ["Si María tiene 6 dulces y Juan 4, ¿quién tiene más?", ["María","Juan","Igual","Ninguno"], "María"],
                    ];
                    break;

                case "Comparación de Números":
                    $preguntas = [
                        ["¿Cuál es mayor: 5 o 7?", ["5","7","Igual","Ninguno"], "7"],
                        ["¿Cuál es menor: 3 o 6?", ["3","6","Igual","Ninguno"], "3"],
                        ["¿5 es mayor, menor o igual a 5?", ["Mayor","Menor","Igual","Ninguno"], "Igual"],
                        ["¿10 es mayor o menor que 8?", ["Mayor","Menor","Igual","Ninguno"], "Mayor"],
                        ["¿2 es menor que 4?", ["Sí","No","Igual","Ninguno"], "Sí"],
                        ["¿7 es mayor que 9?", ["Sí","No","Igual","Ninguno"], "No"],
                        ["¿6 es igual a 6?", ["Sí","No","Ninguno","Igual"], "Sí"],
                        ["¿3 es menor que 1?", ["Sí","No","Igual","Ninguno"], "No"],
                        ["¿4 es mayor que 2?", ["Sí","No","Igual","Ninguno"], "Sí"],
                        ["¿8 es igual a 8?", ["Sí","No","Ninguno","Igual"], "Sí"],
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
