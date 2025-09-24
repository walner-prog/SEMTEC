<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class PreguntaSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Preguntas para cada juego (10 por juego)
        $preguntasPorJuego = [
            "Suma y Resta" => [
                ["¿Cuánto es 7 + 5?", ["10", "11", "12", "13"], "12"],
                ["¿Cuánto es 15 - 8?", ["6", "7", "8", "9"], "7"],
                ["¿Cuánto es 9 + 6?", ["14", "15", "16", "17"], "15"],
                ["¿Cuánto es 20 - 11?", ["8", "9", "10", "11"], "9"],
                ["¿Cuánto es 13 + 4?", ["15", "16", "17", "18"], "17"],
                ["¿Cuánto es 18 - 9?", ["7", "8", "9", "10"], "9"],
                ["¿Cuánto es 25 + 10?", ["30", "32", "34", "35"], "35"],
                ["¿Cuánto es 40 - 15?", ["24", "25", "26", "27"], "25"],
                ["¿Cuánto es 8 + 14?", ["20", "21", "22", "23"], "22"],
                ["¿Cuánto es 50 - 25?", ["23", "24", "25", "26"], "25"],
            ],
            "Problemas Matemáticos" => [
                ["Si Ana tiene 5 manzanas y compra 3 más, ¿cuántas tiene en total?", ["6", "7", "8", "9"], "8"],
                ["Pedro tenía 12 caramelos, regaló 4. ¿Cuántos le quedan?", ["6", "7", "8", "9"], "8"],
                ["Un autobús lleva 20 personas, suben 5 más. ¿Cuántas hay ahora?", ["23", "24", "25", "26"], "25"],
                ["Si Juan tiene 10 lápices y pierde 2, ¿cuántos le quedan?", ["6", "7", "8", "9"], "8"],
                ["Un niño tiene 15 globos, se le revientan 7. ¿Cuántos quedan?", ["7", "8", "9", "10"], "8"],
                ["En una caja hay 30 galletas y se comen 12. ¿Cuántas quedan?", ["17", "18", "19", "20"], "18"],
                ["Luis tenía 40 monedas, gasta 15. ¿Cuántas tiene ahora?", ["24", "25", "26", "27"], "25"],
                ["María tiene 18 flores y le regalan 12 más. ¿Cuántas tiene ahora?", ["28", "29", "30", "31"], "30"],
                ["Si en un salón hay 35 alumnos y entran 5 más, ¿cuántos hay en total?", ["39", "40", "41", "42"], "40"],
                ["Un niño lee 10 páginas por día. ¿Cuántas leerá en 3 días?", ["28", "29", "30", "31"], "30"],
            ],
            "Multiplicaciones" => [
                ["¿Cuánto es 3 × 4?", ["10", "11", "12", "13"], "12"],
                ["¿Cuánto es 5 × 6?", ["28", "29", "30", "31"], "30"],
                ["¿Cuánto es 7 × 8?", ["54", "55", "56", "57"], "56"],
                ["¿Cuánto es 9 × 3?", ["26", "27", "28", "29"], "27"],
                ["¿Cuánto es 4 × 12?", ["46", "47", "48", "49"], "48"],
                ["¿Cuánto es 10 × 5?", ["48", "49", "50", "51"], "50"],
                ["¿Cuánto es 11 × 11?", ["120", "121", "122", "123"], "121"],
                ["¿Cuánto es 8 × 7?", ["54", "55", "56", "57"], "56"],
                ["¿Cuánto es 6 × 9?", ["52", "53", "54", "55"], "54"],
                ["¿Cuánto es 12 × 12?", ["143", "144", "145", "146"], "144"],
            ],
            "Divisiones" => [
                ["¿Cuánto es 12 ÷ 3?", ["2", "3", "4", "5"], "4"],
                ["¿Cuánto es 20 ÷ 5?", ["2", "3", "4", "5"], "4"],
                ["¿Cuánto es 36 ÷ 6?", ["5", "6", "7", "8"], "6"],
                ["¿Cuánto es 40 ÷ 8?", ["4", "5", "6", "7"], "5"],
                ["¿Cuánto es 81 ÷ 9?", ["8", "9", "10", "11"], "9"],
                ["¿Cuánto es 100 ÷ 10?", ["8", "9", "10", "11"], "10"],
                ["¿Cuánto es 56 ÷ 7?", ["7", "8", "9", "10"], "8"],
                ["¿Cuánto es 45 ÷ 5?", ["7", "8", "9", "10"], "9"],
                ["¿Cuánto es 64 ÷ 8?", ["6", "7", "8", "9"], "8"],
                ["¿Cuánto es 72 ÷ 12?", ["5", "6", "7", "8"], "6"],
            ],
            "Fracciones" => [
                ["¿Cuál es mayor: 1/2 o 3/4?", ["1/2", "3/4", "Son iguales", "Ninguno"], "3/4"],
                ["¿Cuánto es 1/2 + 1/4?", ["2/4", "3/4", "4/4", "5/4"], "3/4"],
                ["¿Cuánto es 2/3 - 1/3?", ["1/3", "2/3", "3/3", "0"], "1/3"],
                ["¿Cuál es equivalente a 2/4?", ["1/2", "3/4", "2/2", "1/3"], "1/2"],
                ["¿Cuánto es 3/5 + 1/5?", ["3/5", "4/5", "5/5", "6/5"], "4/5"],
                ["¿Cuál es menor: 2/3 o 3/5?", ["2/3", "3/5", "Son iguales", "Ninguno"], "3/5"],
                ["¿Cuánto es 5/10 + 2/10?", ["6/10", "7/10", "8/10", "9/10"], "7/10"],
                ["¿Cuál es equivalente a 4/8?", ["1/2", "2/4", "Ambos", "Ninguno"], "Ambos"],
                ["¿Cuánto es 1/3 + 1/6?", ["1/6", "1/3", "1/2", "2/3"], "1/2"],
                ["¿Cuánto es 7/8 - 3/8?", ["2/8", "3/8", "4/8", "5/8"], "4/8"],
            ],



            "Secuencias Numéricas" => [
                ["¿Qué número sigue en la secuencia: 2, 4, 6, 8, ...?", ["9", "10", "11", "12"], "10"],
                ["Completa: 5, 10, 15, 20, ...", ["22", "23", "24", "25"], "25"],
                ["¿Qué número falta? 1, 3, 5, __, 9", ["6", "7", "8", "10"], "7"],
                ["Completa: 2, 4, 8, 16, ...", ["24", "30", "32", "36"], "32"],
                ["¿Qué número falta? 100, 90, 80, __, 60", ["50", "65", "70", "75"], "70"],
                ["Completa: 1, 4, 9, 16, ...", ["20", "25", "30", "36"], "25"],
                ["¿Qué número sigue? 50, 45, 40, 35, ...", ["30", "32", "33", "34"], "30"],
                ["Completa: 3, 6, 12, 24, ...", ["36", "40", "46", "48"], "48"],
                ["¿Qué número falta? 7, 14, __, 28, 35", ["20", "21", "22", "23"], "21"],
                ["Completa: 1, 2, 4, 8, 16, ...", ["24", "30", "32", "36"], "32"],
            ],

            "Geometría" => [
                ["¿Cuántos lados tiene un triángulo?", ["2", "3", "4", "5"], "3"],
                ["¿Cuántos lados tiene un hexágono?", ["5", "6", "7", "8"], "6"],
                ["¿Cuál es el área de un cuadrado de lado 4?", ["12", "14", "16", "18"], "16"],
                ["¿Cuál es el perímetro de un cuadrado de lado 5?", ["15", "20", "25", "30"], "20"],
                ["¿Cómo se llama la figura con 8 lados?", ["Pentágono", "Hexágono", "Octágono", "Decágono"], "Octágono"],
                ["¿Cuál es el área de un rectángulo de 6×3?", ["12", "15", "18", "24"], "18"],
                ["¿Qué figura tiene 0 lados?", ["Círculo", "Cuadrado", "Triángulo", "Rectángulo"], "Círculo"],
                ["¿Cuántos vértices tiene un cubo?", ["6", "8", "10", "12"], "8"],
                ["¿Cuántas caras tiene un cubo?", ["4", "5", "6", "8"], "6"],
                ["¿Qué figura tiene forma de pelota?", ["Cubo", "Cilindro", "Esfera", "Cono"], "Esfera"],
            ],

            "Medidas y Unidades" => [
                ["¿Cuántos centímetros tiene un metro?", ["10", "50", "100", "1000"], "100"],
                ["¿Cuántos metros tiene un kilómetro?", ["100", "500", "1000", "2000"], "1000"],
                ["¿Cuántos minutos tiene una hora?", ["30", "45", "60", "90"], "60"],
                ["¿Cuántos días tiene una semana?", ["5", "6", "7", "8"], "7"],
                ["Si un litro de jugo cuesta 20 córdobas, ¿cuánto costarán 2 litros?", ["30", "35", "40", "45"], "40"],
                ["¿Cuántos gramos tiene 1 kilogramo?", ["10", "100", "1000", "2000"], "1000"],
                ["¿Cuál es mayor: 1 metro o 150 cm?", ["1 metro", "150 cm", "Son iguales", "Ninguno"], "150 cm"],
                ["Si un bus recorre 60 km en 1 hora, ¿cuántos km recorre en 2 horas?", ["100", "110", "120", "130"], "120"],
                ["¿Cuántos segundos tiene 1 minuto?", ["30", "45", "60", "90"], "60"],
                ["¿Cuántos meses tiene un año?", ["10", "11", "12", "13"], "12"],
            ],

            "Razonamiento Lógico" => [
                ["Si todos los gatos son animales y algunos animales son perros, ¿los gatos son perros?", ["Sí", "No", "A veces", "Ninguno"], "No"],
                ["Pedro es más alto que Ana y Ana es más alta que Juan. ¿Quién es el más bajo?", ["Pedro", "Ana", "Juan", "Ninguno"], "Juan"],
                ["Un lápiz cuesta 5 córdobas y una goma 3. ¿Cuánto valen juntos?", ["6", "7", "8", "9"], "8"],
                ["Si hoy es lunes, ¿qué día será dentro de 2 días?", ["Martes", "Miércoles", "Jueves", "Viernes"], "Miércoles"],
                ["Si un reloj marca las 3:00, ¿cuántas horas faltan para las 6:00?", ["2", "3", "4", "5"], "3"],
                ["En una fila hay 5 niños. José está delante de Ana, y Ana delante de Luis. ¿Quién está primero?", ["José", "Ana", "Luis", "Ninguno"], "José"],
                ["Si un número es par, ¿qué sucede al sumarle otro número par?", ["Sigue par", "Se vuelve impar", "Es cero", "Ninguno"], "Sigue par"],
                ["Un gallo pone un huevo en el techo, ¿de qué lado caerá?", ["Derecha", "Izquierda", "No pone", "Ambos"], "No pone"],
                ["Si hoy es 31 de diciembre, ¿qué día será mañana?", ["1 de enero", "30 de diciembre", "2 de enero", "Ninguno"], "1 de enero"],
                ["En una granja hay 3 vacas y 2 caballos. ¿Cuántos animales hay?", ["4", "5", "6", "7"], "5"],
            ],

            "Velocidad Mental" => [
                ["¿Cuánto es 8 + 7?", ["14", "15", "16", "17"], "15"],
                ["¿Cuánto es 12 - 9?", ["2", "3", "4", "5"], "3"],
                ["¿Cuánto es 6 × 5?", ["28", "29", "30", "31"], "30"],
                ["¿Cuánto es 20 ÷ 4?", ["4", "5", "6", "7"], "5"],
                ["¿Cuánto es 9 + 9?", ["16", "17", "18", "19"], "18"],
                ["¿Cuánto es 50 - 25?", ["23", "24", "25", "26"], "25"],
                ["¿Cuánto es 7 × 7?", ["48", "49", "50", "51"], "49"],
                ["¿Cuánto es 36 ÷ 6?", ["4", "5", "6", "7"], "6"],
                ["¿Cuánto es 15 + 12?", ["25", "26", "27", "28"], "27"],
                ["¿Cuánto es 100 - 75?", ["20", "25", "30", "35"], "25"],
            ],

            "Matemagia" => [
                ["Piensa un número, súmale 5 y réstale 5. ¿Qué obtienes?", ["El mismo número", "0", "10", "Otro"], "El mismo número"],
                ["Si piensas en 10, lo multiplicas por 2 y luego lo divides entre 2, ¿qué queda?", ["5", "10", "20", "Ninguno"], "10"],
                ["Si eliges 7, le sumas 3 y multiplicas por 2, ¿qué obtienes?", ["18", "19", "20", "21"], "20"],
                ["Piensa un número, multiplícalo por 0. ¿Qué da?", ["El mismo número", "0", "1", "Ninguno"], "0"],
                ["Si un número lo divides entre sí mismo (≠0), ¿qué da?", ["0", "1", "El doble", "Ninguno"], "1"],
                ["Piensa en 5, súmale 5 y réstale 2. ¿Qué queda?", ["6", "7", "8", "9"], "8"],
                ["Si multiplicas cualquier número par por 2, ¿qué obtienes?", ["Un impar", "Otro par", "Siempre 0", "Ninguno"], "Otro par"],
                ["Piensa en 3, multiplícalo por 3 y réstale 3", ["3", "6", "7", "9"], "6"],
                ["Si piensas en 9, lo divides entre 3 y lo multiplicas por 4", ["10", "11", "12", "13"], "12"],
                ["Si eliges 2, lo elevas al cuadrado y sumas 2", ["4", "5", "6", "8"], "6"],
            ],

            "Quiz de Matemáticas" => [
                ["¿Cuál es el número par?", ["3", "5", "8", "11"], "8"],
                ["¿Cuál es el número primo?", ["4", "6", "7", "8"], "7"],
                ["¿Cuánto es 2 + 3 × 2?", ["8", "10", "12", "14"], "8"],
                ["¿Cuál es el resultado de 100 ÷ 25?", ["2", "3", "4", "5"], "4"],
                ["¿Cuánto es 12 + 15?", ["25", "26", "27", "28"], "27"],
                ["¿Cuál es la mitad de 50?", ["20", "25", "30", "35"], "25"],
                ["¿Qué fracción es equivalente a 2/4?", ["1/2", "3/4", "2/2", "1/3"], "1/2"],
                ["¿Cuántos lados tiene un pentágono?", ["4", "5", "6", "7"], "5"],
                ["¿Cuál es la suma de los ángulos de un triángulo?", ["90°", "120°", "180°", "360°"], "180°"],
                ["¿Cuánto es 9 × 9?", ["80", "81", "82", "83"], "81"],
            ],
        ];



        // Insertar en BD
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
