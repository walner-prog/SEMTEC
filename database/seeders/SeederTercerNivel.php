<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederTercerNivel extends Seeder
{
    public function run(): void
    {
        $juegosTercerGrado = [
            ["Suma Avanzada", "fa-plus", "Suma números hasta 100.", 3, "Matemáticas"],
            ["Resta Avanzada", "fa-minus", "Resta números hasta 100.", 3, "Matemáticas"],
            ["Multiplicación Intermedia", "fa-xmark", "Multiplica números hasta 10.", 3, "Matemáticas"],
            ["División Intermedia", "fa-divide", "Divide números hasta 100.", 3, "Matemáticas"],
            ["Fracciones Básicas", "fa-pie-chart", "Aprende a sumar y comparar fracciones simples.", 3, "Fracciones"],
            ["Secuencias Numéricas", "fa-list-ol", "Completa secuencias hasta 100.", 3, "Matemáticas"],
            ["Geometría Básica", "fa-shapes", "Identifica figuras y sus propiedades.", 3, "Geometría/Medidas"],
            ["Medidas y Unidades", "fa-ruler", "Aprende centímetros, metros y kilogramos.", 3, "Geometría/Medidas"],
            ["Problemas Matemáticos", "fa-brain", "Resuelve problemas cotidianos con números mayores.", 3, "Razonamiento/Problemas"],
            ["Razonamiento Lógico", "fa-puzzle-piece", "Ejercita tu mente con acertijos simples.", 3, "Razonamiento/Problemas"],
        ];

        foreach ($juegosTercerGrado as $j) {
            $juego = Juego::create([
                'nombre' => $j[0],
                'icono' => $j[1],
                'descripcion' => $j[2],
                'puntos_base' => 15,
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
                        ["¿Cuánto es 25 + 37?", ["61","62","63","64"], "62"],
                        ["¿Cuánto es 48 + 15?", ["62","63","64","65"], "63"],
                        ["¿Cuánto es 33 + 28?", ["60","61","62","63"], "61"],
                        ["¿Cuánto es 17 + 29?", ["45","46","47","48"], "46"],
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
                        ["¿Cuánto es 87 - 45?", ["41","42","43","44"], "42"],
                        ["¿Cuánto es 63 - 28?", ["34","35","36","37"], "35"],
                        ["¿Cuánto es 50 - 19?", ["30","31","32","33"], "31"],
                        ["¿Cuánto es 72 - 38?", ["33","34","35","36"], "34"],
                        ["¿Cuánto es 95 - 47?", ["47","48","49","50"], "48"],
                        ["¿Cuánto es 68 - 29?", ["38","39","40","41"], "39"],
                        ["¿Cuánto es 54 - 26?", ["27","28","29","30"], "28"],
                        ["¿Cuánto es 81 - 33?", ["47","48","49","50"], "48"],
                        ["¿Cuánto es 77 - 39?", ["36","37","38","39"], "38"],
                        ["¿Cuánto es 66 - 28?", ["37","38","39","40"], "38"],
                    ];
                    break;

                case "Multiplicación Intermedia":
                    $preguntas = [
                        ["¿Cuánto es 6 × 7?", ["41","42","43","44"], "42"],
                        ["¿Cuánto es 8 × 5?", ["38","39","40","41"], "40"],
                        ["¿Cuánto es 9 × 3?", ["26","27","28","29"], "27"],
                        ["¿Cuánto es 7 × 6?", ["41","42","43","44"], "42"],
                        ["¿Cuánto es 5 × 8?", ["39","40","41","42"], "40"],
                        ["¿Cuánto es 4 × 9?", ["35","36","37","38"], "36"],
                        ["¿Cuánto es 3 × 7?", ["20","21","22","23"], "21"],
                        ["¿Cuánto es 2 × 12?", ["23","24","25","26"], "24"],
                        ["¿Cuánto es 6 × 8?", ["46","47","48","49"], "48"],
                        ["¿Cuánto es 9 × 4?", ["35","36","37","38"], "36"],
                    ];
                    break;

                case "División Intermedia":
                    $preguntas = [
                        ["¿Cuánto es 42 ÷ 6?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 56 ÷ 8?", ["6","7","8","9"], "7"],
                        ["¿Cuánto es 81 ÷ 9?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 72 ÷ 8?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 64 ÷ 8?", ["7","8","9","10"], "8"],
                        ["¿Cuánto es 54 ÷ 6?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 48 ÷ 6?", ["7","8","9","10"], "8"],
                        ["¿Cuánto es 90 ÷ 10?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 36 ÷ 4?", ["8","9","10","11"], "9"],
                        ["¿Cuánto es 81 ÷ 3?", ["26","27","28","29"], "27"],
                    ];
                    break;

                case "Fracciones Básicas":
                    $preguntas = [
                        ["¿Cuál es 1/2 + 1/4?", ["2/4","3/4","1/1","1/2"], "3/4"],
                        ["¿Cuál es 3/4 - 1/4?", ["1/2","2/4","3/4","1/4"], "2/4"],
                        ["¿Qué fracción es mayor: 2/3 o 3/5?", ["2/3","3/5","Iguales","Ninguna"], "2/3"],
                        ["¿Cuál es equivalente a 2/4?", ["1/2","2/2","3/4","1/3"], "1/2"],
                        ["¿Cuál es 1/3 + 1/3?", ["1/3","2/3","1/2","1"], "2/3"],
                        ["¿Cuál es menor: 1/2 o 1/3?", ["1/2","1/3","Iguales","Ninguna"], "1/3"],
                        ["¿Cuál es 2/5 + 1/5?", ["2/5","3/5","4/5","5/5"], "3/5"],
                        ["¿Cuál es 3/6 - 1/6?", ["1/6","2/6","3/6","4/6"], "2/6"],
                        ["¿Cuál es 1/4 + 1/2?", ["2/4","3/4","4/4","1/1"], "3/4"],
                        ["¿Cuál es 5/10 - 2/10?", ["2/10","3/10","4/10","5/10"], "3/10"],
                    ];
                    break;

                case "Secuencias Numéricas":
                    $preguntas = [
                        ["Completa: 5, 10, 15, __, 25", ["18","20","22","24"], "20"],
                        ["Completa: 2, 4, 6, __, 10", ["7","8","9","10"], "8"],
                        ["Completa: 3, 6, 9, __, 15", ["11","12","13","14"], "12"],
                        ["Completa: 10, 20, 30, __, 50", ["35","40","45","50"], "40"],
                        ["Completa: 1, 3, 5, __, 9", ["6","7","8","9"], "7"],
                        ["Completa: 2, 6, 10, __, 18", ["12","14","15","16"], "14"],
                        ["Completa: 4, 8, 12, __, 20", ["15","16","17","18"], "16"],
                        ["Completa: 7, 14, 21, __, 35", ["27","28","29","30"], "28"],
                        ["Completa: 5, 15, 25, __, 45", ["30","35","40","42"], "35"],
                        ["Completa: 6, 12, 18, __, 30", ["22","24","26","28"], "24"],
                    ];
                    break;

                case "Geometría Básica":
                    $preguntas = [
                        ["¿Cuántos lados tiene un pentágono?", ["4","5","6","7"], "5"],
                        ["¿Cuántos lados tiene un hexágono?", ["5","6","7","8"], "6"],
                        ["¿Cuántos lados tiene un triángulo?", ["2","3","4","5"], "3"],
                        ["¿Cuántos lados tiene un cuadrado?", ["3","4","5","6"], "4"],
                        ["¿Cuántos vértices tiene un cubo?", ["6","8","10","12"], "8"],
                        ["¿Cuántas caras tiene un cubo?", ["4","5","6","8"], "6"],
                        ["¿Cuál es un círculo?", ["Cuadrado","Triángulo","Círculo","Rectángulo"], "Círculo"],
                        ["¿Cuál es un triángulo?", ["Cuadrado","Triángulo","Círculo","Rectángulo"], "Triángulo"],
                        ["¿Cuál es un cuadrado?", ["Cuadrado","Triángulo","Círculo","Rectángulo"], "Cuadrado"],
                        ["¿Cuál figura tiene 8 lados?", ["Hexágono","Octágono","Heptágono","Pentágono"], "Octágono"],
                    ];
                    break;

                case "Medidas y Unidades":
                    $preguntas = [
                        ["¿Cuántos centímetros hay en 2 metros?", ["100","200","300","400"], "200"],
                        ["¿Cuántos metros hay en 5 kilómetros?", ["5000","1000","2000","2500"], "5000"],
                        ["¿Cuántos gramos hay en 3 kilogramos?", ["1000","2000","3000","4000"], "3000"],
                        ["¿Cuántos minutos hay en 3 horas?", ["120","180","200","150"], "180"],
                        ["¿Cuántos segundos hay en 2 minutos?", ["100","110","120","130"], "120"],
                        ["Si un litro de jugo cuesta 8 córdobas, ¿cuánto cuestan 3 litros?", ["24","25","26","27"], "24"],
                        ["Si un kilo de manzanas cuesta 20 córdobas, ¿cuánto cuestan 5 kilos?", ["90","100","110","120"], "100"],
                        ["Si corro 3 km cada día, ¿cuánto corro en 4 días?", ["10","11","12","13"], "12"],
                        ["Si tienes 6 litros y consumes 2, ¿cuánto queda?", ["3","4","5","6"], "4"],
                        ["¿Cuántos días hay en 2 semanas?", ["12","13","14","15"], "14"],
                    ];
                    break;

                case "Problemas Matemáticos":
                    $preguntas = [
                        ["Si Ana tiene 12 manzanas y da 5 a su amigo, ¿cuántas le quedan?", ["6","7","8","9"], "7"],
                        ["Pedro tenía 20 caramelos y regala 8, ¿cuántos le quedan?", ["10","11","12","13"], "12"],
                        ["En una granja hay 15 ovejas y nacen 3 más, ¿cuántas hay?", ["17","18","19","20"], "18"],
                        ["Luis tenía 30 lápices y pierde 12, ¿cuántos le quedan?", ["17","18","19","20"], "18"],
                        ["Si tienes 25 globos y explotan 6, ¿cuántos quedan?", ["18","19","20","21"], "19"],
                        ["Una tienda tiene 50 juguetes y vende 20, ¿cuántos quedan?", ["28","29","30","31"], "30"],
                        ["Si un niño tiene 40 monedas y gasta 15, ¿cuántas le quedan?", ["24","25","26","27"], "25"],
                        ["Si María compra 12 dulces y come 3, ¿cuántos le quedan?", ["8","9","10","11"], "9"],
                        ["Si en un salón hay 28 alumnos y llegan 4 más, ¿cuántos hay?", ["31","32","33","34"], "32"],
                        ["Si tienes 15 lápices y recibes 10 más, ¿cuántos tienes?", ["24","25","26","27"], "25"],
                    ];
                    break;

                case "Razonamiento Lógico":
                    $preguntas = [
                        ["Si todos los perros son animales y algunos animales son gatos, ¿los perros son gatos?", ["Sí","No","A veces","Ninguno"], "No"],
                        ["Si hoy es martes, ¿qué día será dentro de 3 días?", ["Viernes","Miércoles","Jueves","Sábado"], "Viernes"],
                        ["Juan es más alto que Ana y Ana es más alta que Luis. ¿Quién es el más bajo?", ["Juan","Ana","Luis","Ninguno"], "Luis"],
                        ["Si un número impar se suma con un número par, ¿qué resultado da?", ["Impar","Par","Cero","Ninguno"], "Impar"],
                        ["Si un pájaro pone un huevo, ¿qué pasa?", ["Cae","Se rompe","No pone","Vuela"], "No pone"],
                        ["Si hoy es 30 de abril, ¿qué día será mañana?", ["1 de mayo","29 de abril","2 de mayo","Ninguno"], "1 de mayo"],
                        ["En una fila hay 4 niños. Ana está delante de Luis y Luis delante de Juan. ¿Quién está primero?", ["Ana","Luis","Juan","Ninguno"], "Ana"],
                        ["Si tienes 3 pelotas y compras 2 más, ¿cuántas tienes?", ["4","5","6","7"], "5"],
                        ["Si un gato tiene 4 patas y hay 3 gatos, ¿cuántas patas hay?", ["10","11","12","13"], "12"],
                        ["Si María tiene 7 dulces y Juan 5, ¿quién tiene más?", ["María","Juan","Igual","Ninguno"], "María"],
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
