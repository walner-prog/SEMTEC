<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class PreguntaBloqueadosSeeder extends Seeder
{
    public function run(): void
    {
        $preguntasPorJuego = [
            "Álgebra" => [
                ["¿Cuánto vale x en la ecuación 2x + 4 = 10?", ["2", "3", "4", "5"], "3"],
                ["Si x = 5, ¿cuánto vale 3x + 2?", ["15", "17", "20", "12"], "17"],
                ["Resuelve: x – 7 = 8", ["15", "12", "8", "5"], "15"],
                ["Si x = 2, ¿cuál es el valor de x² + 3?", ["5", "6", "7", "8"], "7"],
                ["¿Cuál es la solución de 5x = 25?", ["4", "5", "6", "7"], "5"],
                ["Resuelve: 12 – x = 4", ["6", "7", "8", "9"], "8"],
                ["Si x = 10, ¿cuánto vale x ÷ 2?", ["2", "3", "4", "5"], "5"],
                ["Resuelve: 3x = 18", ["4", "5", "6", "7"], "6"],
                ["Si x = 4, ¿cuánto vale 2x + 5?", ["10", "11", "12", "13"], "13"],
                ["¿Cuál es la solución de x + 9 = 20?", ["9", "10", "11", "12"], "11"],
            ],

            "Estadística" => [
                ["¿Cuál es la moda de la serie: 2, 4, 4, 5, 7?", ["2", "4", "5", "7"], "4"],
                ["¿Cuál es el promedio de: 10, 20, 30?", ["10", "15", "20", "25"], "20"],
                ["Si en una encuesta 15 prefieren manzanas y 5 naranjas, ¿qué fruta es más popular?", ["Manzanas", "Naranjas", "Iguales", "No se sabe"], "Manzanas"],
                ["En los datos 3, 6, 9, ¿cuál es la media?", ["5", "6", "7", "8"], "6"],
                ["En una clase, 12 son niños y 18 son niñas. ¿Cuál es el total?", ["20", "25", "30", "35"], "30"],
                ["¿Cuál es la mediana de: 1, 3, 5, 7, 9?", ["3", "5", "7", "9"], "5"],
                ["Si 10 estudiantes sacaron 8 y 5 sacaron 10, ¿qué nota es la moda?", ["8", "9", "10", "Ninguna"], "8"],
                ["¿Cuál es la media de: 4, 8, 12, 16?", ["8", "10", "12", "14"], "10"],
                ["Si un gráfico muestra 20 pelotas rojas y 10 azules, ¿qué color es más frecuente?", ["Rojo", "Azul", "Iguales", "No se sabe"], "Rojo"],
                ["En los datos 2, 2, 3, 4, 5, ¿cuál es la moda?", ["2", "3", "4", "5"], "2"],
            ],

            "Porcentajes" => [
                ["¿Cuál es el 50% de 20?", ["5", "10", "15", "20"], "10"],
                ["Si un precio era 100 y bajó un 10%, ¿en cuánto queda?", ["80", "85", "90", "95"], "90"],
                ["El 25% de 200 es:", ["25", "50", "100", "150"], "50"],
                ["Si una camisa vale 80 y tiene 20% de descuento, ¿cuánto se paga?", ["60", "64", "70", "72"], "64"],
                ["¿Cuál es el 10% de 500?", ["10", "20", "50", "100"], "50"],
                ["Si un número aumenta en 50% y era 40, ¿cuánto vale ahora?", ["50", "55", "60", "65"], "60"],
                ["El 75% de 80 es:", ["50", "55", "60", "65"], "60"],
                ["Un artículo cuesta 120 y subió 10%. ¿Cuál es el nuevo precio?", ["125", "130", "132", "135"], "132"],
                ["¿Cuál es el 20% de 300?", ["40", "50", "60", "70"], "60"],
                ["Un examen tiene 40 preguntas, si respondes bien el 75%, ¿cuántas correctas tienes?", ["20", "25", "30", "35"], "30"],
            ],

            "Tiempo y Relojes" => [
                ["¿Cuántos minutos tiene una hora?", ["30", "45", "60", "90"], "60"],
                ["Si son las 3:00 y pasan 2 horas, ¿qué hora es?", ["4:00", "5:00", "6:00", "7:00"], "5:00"],
                ["¿Cuántos segundos tiene un minuto?", ["30", "45", "60", "100"], "60"],
                ["Si un partido empieza a las 4:00 y dura 2 horas, ¿a qué hora termina?", ["5:00", "6:00", "7:00", "8:00"], "6:00"],
                ["¿Cuántas horas tiene un día?", ["12", "24", "48", "60"], "24"],
                ["Si son las 9:30 y pasan 30 minutos, ¿qué hora es?", ["9:45", "10:00", "10:15", "10:30"], "10:00"],
                ["¿Cuántos días tiene una semana?", ["5", "6", "7", "8"], "7"],
                ["Si son las 11:00 y pasan 3 horas, ¿qué hora es?", ["12:00", "1:00", "2:00", "3:00"], "2:00"],
                ["¿Cuántos meses tiene un año?", ["10", "11", "12", "13"], "12"],
                ["Si son las 6:45 y pasan 15 minutos, ¿qué hora es?", ["7:00", "7:15", "7:30", "8:00"], "7:00"],
            ],

            "Medidas Avanzadas" => [
                ["¿Cuántos litros hay en 1 metro cúbico?", ["10", "100", "500", "1000"], "1000"],
                ["Si un balde tiene 20 litros y usas 5, ¿cuánto queda?", ["10", "12", "15", "18"], "15"],
                ["Un litro equivale a cuántos mililitros:", ["10", "100", "1000", "10000"], "1000"],
                ["Si un envase tiene 500 ml y compras 2, ¿cuánto tienes en litros?", ["0.5", "1", "1.5", "2"], "1"],
                ["¿Cuál es la unidad para medir la capacidad de agua en una piscina?", ["Litros", "Metros", "Kilogramos", "Segundos"], "Litros"],
                ["Si una caja mide 2m x 2m x 2m, ¿cuál es su volumen?", ["4", "6", "8", "8 m³"], "8 m³"],
                ["Un tanque tiene 200 litros, si usas 50, ¿cuánto queda?", ["100", "120", "150", "160"], "150"],
                ["¿Cuántos ml tiene medio litro?", ["100", "250", "400", "500"], "500"],
                ["Si un vaso tiene 250 ml, ¿cuántos vasos son 1 litro?", ["2", "3", "4", "5"], "4"],
                ["¿Qué unidad usamos para medir la leche?", ["Metros", "Litros", "Gramos", "Segundos"], "Litros"],
            ],

            "Probabilidad" => [
                ["Si lanzas una moneda, ¿qué probabilidad hay de que salga cara?", ["0", "1/2", "1/3", "1"], "1/2"],
                ["En un dado, ¿qué probabilidad hay de sacar un 6?", ["1/2", "1/4", "1/6", "1/8"], "1/6"],
                ["Si una bolsa tiene 3 bolas rojas y 1 azul, ¿qué probabilidad hay de sacar azul?", ["1/2", "1/3", "1/4", "1"], "1/4"],
                ["En un mazo de 4 cartas (A, 2, 3, 4), ¿probabilidad de sacar un número mayor que 2?", ["1/2", "1/3", "1/4", "3/4"], "1/2"],
                ["Si lanzas un dado, ¿probabilidad de obtener número par?", ["1/2", "1/3", "1/6", "2/3"], "1/2"],
                ["En una bolsa con 2 verdes y 2 rojas, ¿probabilidad de sacar verde?", ["1/2", "1/3", "1/4", "1"], "1/2"],
                ["Si giras una ruleta con 8 partes iguales, ¿probabilidad de caer en una parte?", ["1/4", "1/8", "1/2", "1"], "1/8"],
                ["En un dado, ¿probabilidad de sacar menor que 3?", ["1/2", "1/3", "1/6", "2/3"], "1/3"],
                ["Si hay 10 caramelos (4 rojos, 6 verdes), probabilidad de sacar rojo:", ["1/2", "2/5", "4/10", "6/10"], "4/10"],
                ["Lanzas dos monedas, probabilidad de que salgan dos caras:", ["1/2", "1/3", "1/4", "1"], "1/4"],
            ],
        ];

        foreach ($preguntasPorJuego as $nombreJuego => $preguntas) {
            $juego = Juego::where('nombre', $nombreJuego)->first();
            if ($juego) {
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
}
