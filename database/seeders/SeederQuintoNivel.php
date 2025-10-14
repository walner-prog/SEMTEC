<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;
use App\Models\Pregunta;

class SeederQuintoNivel extends Seeder
{
    public function run(): void
    {
       $juegos = [
            ["Suma y Resta Avanzada", "Matemáticas"],
            ["Multiplicaciones y Divisiones", "Matemáticas"],
            ["Fracciones y Decimales", "Fracciones/Decimales"],
            ["Problemas Matemáticos Complejos", "Razonamiento/Problemas"],
            ["Geometría y Figuras", "Geometría"],
            ["Medidas y Unidades Avanzadas", "Medidas/Unidades"],
            ["Razonamiento Lógico", "Razonamiento/Problemas"],
            ["Velocidad Mental", "Matemáticas/Velocidad Mental"],
            ["Matemagia", "Razonamiento/Matemagia"],
            ["Quiz de Matemáticas", "Repaso General"]
        ];

        $preguntasPorJuego = [
            "Suma y Resta Avanzada" => [
                ["¿Cuánto es 345 + 678?", ["1013","1023","1003","1020"], "1023"],
                ["¿Cuánto es 987 - 654?", ["333","323","343","334"], "333"],
                ["¿Suma 432 + 289?", ["721","720","722","719"], "721"],
                ["¿Cuánto es 765 - 432?", ["333","332","334","331"], "333"],
                ["¿Suma 258 + 467?", ["725","726","724","723"], "725"],
                ["¿Cuánto es 890 - 345?", ["545","546","544","543"], "545"],
                ["¿Suma 123 + 876?", ["999","1000","998","1001"], "999"],
                ["¿Cuánto es 678 - 123?", ["555","554","556","557"], "555"],
                ["¿Suma 345 + 234?", ["579","578","580","577"], "579"],
                ["¿Cuánto es 765 - 321?", ["444","445","443","446"], "444"],
            ],
            "Multiplicaciones y Divisiones" => [
                ["¿Cuánto es 25 × 12?", ["300","301","299","302"], "300"],
                ["¿Cuánto es 48 ÷ 6?", ["8","7","9","10"], "8"],
                ["¿Cuánto es 14 × 7?", ["98","97","99","100"], "98"],
                ["¿Cuánto es 144 ÷ 12?", ["12","11","13","14"], "12"],
                ["¿Cuánto es 36 × 8?", ["288","287","289","290"], "288"],
                ["¿Cuánto es 81 ÷ 9?", ["9","8","10","7"], "9"],
                ["¿Cuánto es 56 × 6?", ["336","335","337","338"], "336"],
                ["¿Cuánto es 225 ÷ 5?", ["45","44","46","43"], "45"],
                ["¿Cuánto es 32 × 9?", ["288","287","289","290"], "288"],
                ["¿Cuánto es 144 ÷ 8?", ["18","17","19","16"], "18"],
            ],
            "Fracciones y Decimales" => [
                ["¿Convierte 0.6 a fracción?", ["3/5","1/2","2/3","5/6"], "3/5"],
                ["¿Cuánto es 5/6 - 1/3?", ["1/2","1/3","2/3","1/6"], "1/2"],
                ["¿Convierte 0.25 a fracción?", ["1/4","1/2","2/5","1/3"], "1/4"],
                ["¿Cuánto es 3/4 + 2/8?", ["1","3/4","5/8","7/8"], "1"],
                ["¿Cuál es mayor: 5/8 o 3/4?", ["3/4","5/8","Iguales","Ninguno"], "3/4"],
                ["¿Cuánto es 7/10 + 2/5?", ["11/10","9/10","12/10","10/10"], "11/10"],
                ["¿Convierte 0.2 a fracción?", ["1/5","1/2","2/5","1/4"], "1/5"],
                ["¿Cuánto es 4/5 - 2/10?", ["6/10","5/10","7/10","4/10"], "6/10"],
                ["¿Cuál es equivalente a 8/12?", ["2/3","3/4","1/2","4/5"], "2/3"],
                ["¿Cuánto es 3/7 + 2/7?", ["5/7","4/7","6/7","3/7"], "5/7"],
            ],
            "Problemas Matemáticos Complejos" => [
                ["Si compras 3 cajas de 24 galletas, ¿cuántas galletas hay?", ["72","73","71","70"], "72"],
                ["Una piscina tiene 800 litros y se usan 275, ¿cuántos quedan?", ["525","526","524","523"], "525"],
                ["Pedro corre 6 km diarios durante 5 días, ¿cuántos km recorre?", ["30","31","29","32"], "30"],
                ["Un autobús lleva 50 pasajeros, bajan 18, ¿cuántos quedan?", ["32","31","33","30"], "32"],
                ["Si compras 4 paquetes de 12 lápices, ¿cuántos tienes?", ["48","47","49","50"], "48"],
                ["María tenía 200 manzanas y regala 75, ¿cuántas le quedan?", ["125","124","126","123"], "125"],
                ["Si un coche recorre 90 km/h y viaja 3 h, ¿cuántos km recorre?", ["270","265","275","280"], "270"],
                ["Un tren tiene 150 pasajeros y suben 25, ¿cuántos hay?", ["175","176","174","177"], "175"],
                ["Si en una caja hay 500 galletas y se comen 200, ¿cuántas quedan?", ["300","301","299","302"], "300"],
                ["Ana compra 3 juguetes a 45 c/u, ¿cuánto paga?", ["135","136","134","137"], "135"],
            ],
            "Geometría y Figuras" => [
                ["¿Cuántos lados tiene un octágono?", ["8","7","9","6"], "8"],
                ["¿Cuál es el área de un triángulo de base 6 y altura 4?", ["12","11","13","14"], "12"],
                ["¿Cuál es el perímetro de un cuadrado de lado 9?", ["36","35","37","34"], "36"],
                ["¿Cuántos vértices tiene un cubo?", ["8","6","10","12"], "8"],
                ["¿Cuántas caras tiene un cubo?", ["6","8","5","7"], "6"],
                ["¿Qué figura tiene 3 lados?", ["Triángulo","Cuadrado","Rectángulo","Círculo"], "Triángulo"],
                ["¿Cuál es el área de un rectángulo de 7×5?", ["35","34","36","33"], "35"],
                ["¿Cuántos lados tiene un dodecágono?", ["12","10","11","13"], "12"],
                ["¿Qué figura tiene 0 lados?", ["Círculo","Cuadrado","Triángulo","Rectángulo"], "Círculo"],
                ["¿Cuál es el perímetro de un triángulo de lados 5,6,7?", ["18","17","19","16"], "18"],
            ],
            "Medidas y Unidades Avanzadas" => [
                ["¿Cuántos cm hay en 5 m?", ["500","50","5","5000"], "500"],
                ["¿Cuántos kg hay en 3 toneladas?", ["3000","30","300","30000"], "3000"],
                ["¿Cuántos min hay en 2 h?", ["120","100","110","130"], "120"],
                ["¿Cuántos s hay en 5 min?", ["300","250","350","280"], "300"],
                ["Si 1 km = 1000 m, ¿cuántos km son 7500 m?", ["7.5","7","8","7.2"], "7.5"],
                ["¿Cuánto es 3 l + 2 l?", ["5","4","6","3"], "5"],
                ["¿Cuántos g hay en 3 kg?", ["3000","1000","3500","2500"], "3000"],
                ["Si un coche recorre 80 km en 1 h, ¿cuánto recorre en 4 h?", ["320","300","340","310"], "320"],
                ["¿Cuánto mide 2 l en ml?", ["2000","1000","2500","1500"], "2000"],
                ["¿Cuántos min hay en 3 h y 30 min?", ["210","200","220","205"], "210"],
            ],
            "Razonamiento Lógico" => [
                ["Si todos los gatos son animales y algunos animales son perros, ¿los gatos son perros?", ["No","Sí","A veces","Ninguno"], "No"],
                ["Pedro es más alto que Ana y Ana más que Juan. ¿Quién es el más bajo?", ["Juan","Pedro","Ana","Ninguno"], "Juan"],
                ["Si hoy es lunes, ¿qué día será dentro de 4 días?", ["Viernes","Jueves","Miércoles","Sábado"], "Viernes"],
                ["Si un lápiz cuesta 7 y una goma 3, ¿cuánto valen juntos?", ["10","9","11","12"], "10"],
                ["Si multiplicas un número par por otro par, ¿el resultado es par o impar?", ["Par","Impar","Cero","Ninguno"], "Par"],
                ["Un gallo pone un huevo en el techo, ¿de qué lado caerá?", ["No pone","Izquierda","Derecha","Ambos"], "No pone"],
                ["En una fila hay 5 niños, ¿quién está primero?", ["El primero","El último","El del medio","Ninguno"], "El primero"],
                ["Si hoy es 30 de diciembre, ¿qué día será mañana?", ["31 de diciembre","1 de enero","29 de diciembre","2 de enero"], "31 de diciembre"],
                ["Un granjero tiene 7 vacas y 3 caballos, ¿cuántos animales hay?", ["10","9","11","8"], "10"],
                ["Si sumas dos números impares, ¿el resultado es par o impar?", ["Par","Impar","Cero","Ninguno"], "Par"],
            ],
            "Velocidad Mental" => [
                ["¿Cuánto es 56 + 37?", ["93","92","94","91"], "93"],
                ["¿Cuánto es 88 - 29?", ["59","58","60","57"], "59"],
                ["¿Cuánto es 12 × 6?", ["72","71","73","70"], "72"],
                ["¿Cuánto es 144 ÷ 12?", ["12","11","13","14"], "12"],
                ["¿Cuánto es 45 + 38?", ["83","82","84","81"], "83"],
                ["¿Cuánto es 90 - 47?", ["43","42","44","45"], "43"],
                ["¿Cuánto es 18 × 4?", ["72","71","73","70"], "72"],
                ["¿Cuánto es 132 ÷ 6?", ["22","21","23","24"], "22"],
                ["¿Cuánto es 29 + 56?", ["85","84","86","83"], "85"],
                ["¿Cuánto es 96 ÷ 8?", ["12","11","13","14"], "12"],
            ],
            "Matemagia" => [
                ["Piensa un número, súmale 9 y réstale 9, ¿qué obtienes?", ["El mismo número","0","Otro","10"], "El mismo número"],
                ["Si piensas en 16 y lo divides por 4, ¿qué queda?", ["4","3","5","6"], "4"],
                ["Multiplica 7 × 3 y súmale 5, ¿qué obtienes?", ["26","25","27","28"], "26"],
                ["Piensa en 8, multiplícalo por 2 y réstale 3, ¿qué queda?", ["13","12","14","15"], "13"],
                ["Si eliges 9, lo multiplicas por 2 y sumas 4, ¿qué da?", ["22","23","21","24"], "22"],
                ["Piensa un número y súmale 0, ¿qué pasa?", ["Sigue igual","Cambia","Otro","Nada"], "Sigue igual"],
                ["Multiplica 4 × 4 y réstale 4, ¿qué queda?", ["12","13","14","11"], "12"],
                ["Piensa en 10, súmale 5 y réstale 3, ¿qué queda?", ["12","11","13","14"], "12"],
                ["Si divides 36 entre 3 y sumas 6, ¿qué da?", ["18","16","20","19"], "18"],
                ["Piensa un número, réstale 5 y súmale 5, ¿qué obtienes?", ["El mismo número","0","Otro","10"], "El mismo número"],
            ],
            "Quiz de Matemáticas" => [
                ["¿Cuál es primo?", ["5","6","7","8"], "5"],
                ["¿Cuál es par?", ["8","9","6","7"], "8"],
                ["¿Cuánto es 45 + 36?", ["81","80","82","79"], "81"],
                ["¿Cuánto es 120 ÷ 15?", ["8","7","9","6"], "8"],
                ["¿Cuánto es 14 × 7?", ["98","97","99","100"], "98"],
                ["¿Cuál es la mitad de 84?", ["42","41","43","40"], "42"],
                ["¿Qué fracción es equivalente a 6/12?", ["1/2","1/3","2/3","1/4"], "1/2"],
                ["¿Cuántos lados tiene un decágono?", ["10","8","12","9"], "10"],
                ["¿Cuál es la suma de los ángulos de un pentágono?", ["540°","500°","550°","520°"], "540°"],
                ["¿Cuánto es 27 + 35?", ["62","61","63","60"], "62"],
            ],
        ];

      foreach ($juegos as $j) {
    $juego = Juego::create([
        'nombre' => $j[0],
        'nivel' => 5,
        'puntos_base' => 10,
        'tipo' => 'quiz',
        'bloqueado' => false,
        'categoria' => $j[1],
    ]);

    foreach ($preguntasPorJuego[$j[0]] as $p) {
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
