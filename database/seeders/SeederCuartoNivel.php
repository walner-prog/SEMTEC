<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederCuartoNivel extends Seeder
{
    public function run(): void
    {
        $juegos = [
            "Suma y Resta Avanzada",
            "Multiplicaciones y Divisiones",
            "Fracciones y Decimales",
            "Problemas Matemáticos Complejos",
            "Geometría y Figuras",
            "Medidas y Unidades Avanzadas",
            "Razonamiento Lógico",
            "Velocidad Mental",
            "Matemagia",
            "Quiz de Matemáticas"
        ];

        $preguntasPorJuego = [
            "Suma y Resta Avanzada" => [
                ["¿Cuánto es 125 + 278?", ["392","403","403","403"], "403"],
                ["¿Cuánto es 512 - 287?", ["225","225","226","227"], "225"],
                ["¿Suma 345 + 156?", ["501","502","503","500"], "501"],
                ["¿Cuánto es 789 - 456?", ["323","324","325","322"], "323"],
                ["¿Suma 432 + 178?", ["610","610","611","609"], "610"],
                ["¿Cuánto es 650 - 275?", ["375","376","374","373"], "375"],
                ["¿Suma 213 + 487?", ["700","701","699","702"], "700"],
                ["¿Cuánto es 900 - 375?", ["525","526","524","523"], "525"],
                ["¿Suma 134 + 266?", ["400","401","399","402"], "400"],
                ["¿Cuánto es 750 - 320?", ["430","431","429","432"], "430"],
            ],
            "Multiplicaciones y Divisiones" => [
                ["¿Cuánto es 12 × 8?", ["96","95","97","98"], "96"],
                ["¿Cuánto es 15 × 6?", ["90","91","89","92"], "90"],
                ["¿Cuánto es 9 × 7?", ["63","62","64","65"], "63"],
                ["¿Cuánto es 56 ÷ 7?", ["8","7","9","6"], "8"],
                ["¿Cuánto es 72 ÷ 8?", ["9","8","10","7"], "9"],
                ["¿Cuánto es 144 ÷ 12?", ["12","11","13","14"], "12"],
                ["¿Cuánto es 36 × 5?", ["180","181","179","182"], "180"],
                ["¿Cuánto es 84 ÷ 4?", ["21","20","22","19"], "21"],
                ["¿Cuánto es 11 × 11?", ["121","120","122","123"], "121"],
                ["¿Cuánto es 132 ÷ 6?", ["22","21","23","24"], "22"],
            ],
            "Fracciones y Decimales" => [
                ["¿Cuánto es 1/2 + 1/4?", ["3/4","1/2","2/3","1/4"], "3/4"],
                ["¿Cuál es menor: 5/6 o 4/5?", ["4/5","5/6","Iguales","Ninguno"], "4/5"],
                ["¿Convierte 0.75 a fracción", ["3/4","1/2","2/3","5/6"], "3/4"],
                ["¿Cuánto es 2/3 + 1/6?", ["5/6","2/3","3/4","4/6"], "5/6"],
                ["¿Cuál es equivalente a 6/8?", ["3/4","2/3","1/2","6/8"], "3/4"],
                ["¿Convierte 0.25 a fracción", ["1/4","1/2","2/5","1/3"], "1/4"],
                ["¿Cuánto es 7/10 - 1/5?", ["1/2","3/5","4/5","2/5"], "1/2"],
                ["¿Cuál es mayor: 3/5 o 2/3?", ["2/3","3/5","Iguales","Ninguno"], "2/3"],
                ["¿Convierte 0.4 a fracción", ["2/5","1/2","3/5","1/4"], "2/5"],
                ["¿Cuánto es 5/8 + 1/4?", ["7/8","6/8","3/4","5/8"], "7/8"],
            ],
            "Problemas Matemáticos Complejos" => [
                ["Si Juan tiene 45 lápices y reparte 15, ¿cuántos le quedan?", ["30","31","29","28"], "30"],
                ["Una tienda vende 120 manzanas y se venden 45, ¿cuántas quedan?", ["75","76","74","77"], "75"],
                ["Un tren transporta 200 personas, bajan 85, ¿cuántos quedan?", ["115","116","114","117"], "115"],
                ["Ana tiene 60 caramelos y da 25 a su hermano, ¿cuántos le quedan?", ["35","36","34","37"], "35"],
                ["Si compras 3 paquetes de 24 galletas, ¿cuántas galletas hay?", ["72","73","71","70"], "72"],
                ["Un niño tiene 50 globos y explotan 12, ¿cuántos quedan?", ["38","37","39","36"], "38"],
                ["Pedro corre 5 km diarios durante 7 días, ¿cuántos km corre?", ["35","34","36","33"], "35"],
                ["Si una piscina tiene 500 litros y se usan 125, ¿cuántos quedan?", ["375","376","374","373"], "375"],
                ["María compra 3 cajas de 12 lápices, ¿cuántos lápices tiene?", ["36","35","37","34"], "36"],
                ["Si un autobús lleva 40 pasajeros y suben 15 más, ¿cuántos hay?", ["55","56","54","53"], "55"],
            ],
            "Geometría y Figuras" => [
                ["¿Cuántos lados tiene un pentágono?", ["5","4","6","7"], "5"],
                ["¿Cuántos lados tiene un hexágono?", ["6","5","7","8"], "6"],
                ["¿Cuál es el área de un rectángulo de 5×3?", ["15","14","16","13"], "15"],
                ["¿Cuál es el perímetro de un cuadrado de lado 6?", ["24","25","23","26"], "24"],
                ["¿Qué figura tiene 0 lados?", ["Círculo","Triángulo","Cuadrado","Rectángulo"], "Círculo"],
                ["¿Cuántos vértices tiene un cubo?", ["8","6","10","12"], "8"],
                ["¿Cuántas caras tiene un cubo?", ["6","8","5","7"], "6"],
                ["¿Cuál es el área de un triángulo de base 4 y altura 3?", ["6","7","5","8"], "6"],
                ["¿Qué figura tiene 3 lados?", ["Triángulo","Cuadrado","Rectángulo","Círculo"], "Triángulo"],
                ["¿Cuál es el perímetro de un triángulo de lados 3,4,5?", ["12","11","13","10"], "12"],
            ],
            "Medidas y Unidades Avanzadas" => [
                ["¿Cuántos cm hay en 3 m?", ["300","30","3","3000"], "300"],
                ["¿Cuántos kg hay en 5 toneladas?", ["5000","50","500","50000"], "5000"],
                ["¿Cuántos min hay en 3 h?", ["180","160","200","150"], "180"],
                ["¿Cuántos s hay en 2 min?", ["120","60","100","90"], "120"],
                ["Si 1 km = 1000 m, ¿cuántos km son 5000 m?", ["5","4","6","10"], "5"],
                ["¿Cuánto es 2 l + 3 l?", ["5","4","6","3"], "5"],
                ["¿Cuántos g hay en 2 kg?", ["2000","1000","1500","2500"], "2000"],
                ["Si un coche recorre 60 km en 1 h, ¿cuánto en 3 h?", ["180","160","200","150"], "180"],
                ["¿Cuánto mide un litro en ml?", ["1000","100","200","500"], "1000"],
                ["¿Cuánto es 3 h en minutos?", ["180","160","200","150"], "180"],
            ],
            "Razonamiento Lógico" => [
                ["Si todos los perros son animales y algunos animales son gatos, ¿los perros son gatos?", ["No","Sí","A veces","Ninguno"], "No"],
                ["Pedro es más alto que Ana y Ana es más alta que Juan. ¿Quién es el más alto?", ["Pedro","Ana","Juan","Ninguno"], "Pedro"],
                ["Si hoy es lunes, ¿qué día será en 3 días?", ["Jueves","Miércoles","Viernes","Martes"], "Jueves"],
                ["Si un lápiz cuesta 5 y una goma 3, ¿cuánto valen juntos?", ["8","7","9","10"], "8"],
                ["Si un número es par, ¿qué pasa al sumarle otro par?", ["Sigue par","Se vuelve impar","Cero","Ninguno"], "Sigue par"],
                ["Un gallo pone un huevo en el techo, ¿de qué lado caerá?", ["No pone","Izquierda","Derecha","Ambos"], "No pone"],
                ["En una fila hay 4 niños, ¿quién está primero?", ["El primero","El último","El del medio","Ninguno"], "El primero"],
                ["Si hoy es 31 de diciembre, ¿qué día será mañana?", ["1 de enero","30 de diciembre","2 de enero","31 de diciembre"], "1 de enero"],
                ["Un granjero tiene 5 vacas y 2 caballos, ¿cuántos animales hay?", ["7","6","8","5"], "7"],
                ["Si multiplicas 2 números impares, ¿el resultado es par o impar?", ["Impar","Par","Cero","Ninguno"], "Impar"],
            ],
            "Velocidad Mental" => [
                ["¿Cuánto es 23 + 15?", ["38","37","39","36"], "38"],
                ["¿Cuánto es 48 - 19?", ["29","28","30","31"], "29"],
                ["¿Cuánto es 7 × 6?", ["42","41","43","40"], "42"],
                ["¿Cuánto es 81 ÷ 9?", ["9","8","10","7"], "9"],
                ["¿Cuánto es 35 + 27?", ["62","61","63","60"], "62"],
                ["¿Cuánto es 50 - 18?", ["32","31","33","34"], "32"],
                ["¿Cuánto es 12 × 4?", ["48","47","49","46"], "48"],
                ["¿Cuánto es 144 ÷ 12?", ["12","11","13","14"], "12"],
                ["¿Cuánto es 29 + 15?", ["44","43","45","46"], "44"],
                ["¿Cuánto es 36 ÷ 6?", ["6","5","7","8"], "6"],
            ],
            "Matemagia" => [
                ["Piensa un número, súmale 7 y réstale 7, ¿qué obtienes?", ["El mismo número","0","Otro","10"], "El mismo número"],
                ["Si piensas en 12 y lo divides por 4, ¿qué queda?", ["3","2","4","1"], "3"],
                ["Multiplica 5 × 2 y súmale 10, ¿qué obtienes?", ["20","25","30","15"], "20"],
                ["Piensa en 7, multiplícalo por 3 y réstale 2, ¿qué queda?", ["19","20","21","22"], "19"],
                ["Si eliges 6, lo multiplicas por 2 y sumas 4, ¿qué da?", ["16","14","12","18"], "16"],
                ["Piensa un número y súmale 0, ¿qué pasa?", ["Sigue igual","Cambia","Otro","Nada"], "Sigue igual"],
                ["Multiplica 3 × 3 y réstale 3, ¿qué queda?", ["6","7","8","9"], "6"],
                ["Piensa en 8, súmale 5 y réstale 3, ¿qué queda?", ["10","11","12","13"], "12"],
                ["Si divides 20 entre 2 y sumas 5, ¿qué da?", ["15","10","20","25"], "15"],
                ["Piensa un número, réstale 2 y súmale 2, ¿qué obtienes?", ["El mismo número","0","Otro","10"], "El mismo número"],
            ],
            "Quiz de Matemáticas" => [
                ["¿Cuál es primo?", ["4","5","6","7"], "5"],
                ["¿Cuál es par?", ["3","5","8","9"], "8"],
                ["¿Cuánto es 12 + 15?", ["27","28","26","25"], "27"],
                ["¿Cuánto es 100 ÷ 25?", ["4","3","5","2"], "4"],
                ["¿Cuánto es 9 × 8?", ["72","71","73","70"], "72"],
                ["¿Cuál es la mitad de 50?", ["25","20","30","15"], "25"],
                ["¿Qué fracción es equivalente a 4/8?", ["1/2","2/3","3/4","1/4"], "1/2"],
                ["¿Cuántos lados tiene un hexágono?", ["6","5","7","8"], "6"],
                ["¿Cuál es la suma de los ángulos de un cuadrado?", ["360°","180°","90°","270°"], "360°"],
                ["¿Cuánto es 15 + 27?", ["42","41","43","40"], "42"],
            ],
        ];

        foreach ($juegos as $nombre) {
            $juego = Juego::create([
                'nombre' => $nombre,
                'nivel' => 4,
                'puntos_base' => 10,
                'tipo' => 'quiz',
                'bloqueado' => false,
            ]);

            foreach ($preguntasPorJuego[$nombre] as $p) {
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
