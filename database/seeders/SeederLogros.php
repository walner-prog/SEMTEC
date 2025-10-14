<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logro;

class SeederLogros extends Seeder
{
    public function run(): void
    {
        $juegos = [
            ["id" => 1, "nombre" => "Suma y Resta"],
            ["id" => 2, "nombre" => "Problemas Matemáticos"],
            ["id" => 3, "nombre" => "Multiplicaciones"],
            ["id" => 4, "nombre" => "Divisiones"],
            ["id" => 5, "nombre" => "Fracciones"],
            ["id" => 6, "nombre" => "Secuencias Numéricas"],
            ["id" => 7, "nombre" => "Geometría"],
            ["id" => 8, "nombre" => "Medidas y Unidades"],
            ["id" => 9, "nombre" => "Razonamiento Lógico"],
            ["id" => 10, "nombre" => "Velocidad Mental"],
            ["id" => 11, "nombre" => "Matemagia"],
            ["id" => 12, "nombre" => "Quiz de Matemáticas"],
            ["id" => 13, "nombre" => "Álgebra"],
            ["id" => 14, "nombre" => "Estadística"],
            ["id" => 15, "nombre" => "Porcentajes"],
            ["id" => 16, "nombre" => "Tiempo y Relojes"],
            ["id" => 17, "nombre" => "Medidas Avanzadas"],
            ["id" => 18, "nombre" => "Probabilidad"],
            ["id" => 19, "nombre" => "Suma Básica"],
            ["id" => 20, "nombre" => "Resta Básica"],
            ["id" => 21, "nombre" => "Contar Objetos"],
            ["id" => 22, "nombre" => "Formas y Figuras"],
            ["id" => 23, "nombre" => "Colores"],
            ["id" => 24, "nombre" => "Animales"],
            ["id" => 25, "nombre" => "Suma Avanzada"],
            ["id" => 26, "nombre" => "Resta Avanzada"],
            ["id" => 27, "nombre" => "Multiplicación Básica"],
            ["id" => 28, "nombre" => "División Básica"],
            ["id" => 29, "nombre" => "Secuencias Numéricas"],
            ["id" => 30, "nombre" => "Figuras Geométricas"],
            ["id" => 31, "nombre" => "Medidas Simples"],
            ["id" => 32, "nombre" => "Problemas de Suma y Resta"],
            ["id" => 33, "nombre" => "Razonamiento Lógico"],
            ["id" => 34, "nombre" => "Comparación de Números"],
            ["id" => 35, "nombre" => "Suma Avanzada"],
            ["id" => 36, "nombre" => "Resta Avanzada"],
            ["id" => 37, "nombre" => "Multiplicación Intermedia"],
            ["id" => 38, "nombre" => "División Intermedia"],
            ["id" => 39, "nombre" => "Fracciones Básicas"],
            ["id" => 40, "nombre" => "Secuencias Numéricas"],
            ["id" => 41, "nombre" => "Geometría Básica"],
            ["id" => 42, "nombre" => "Medidas y Unidades"],
            ["id" => 43, "nombre" => "Problemas Matemáticos"],
            ["id" => 44, "nombre" => "Razonamiento Lógico"],
            ["id" => 45, "nombre" => "Suma y Resta Avanzada"],
            ["id" => 46, "nombre" => "Multiplicaciones y Divisiones"],
            ["id" => 47, "nombre" => "Fracciones y Decimales"],
            ["id" => 48, "nombre" => "Problemas Matemáticos Complejos"],
            ["id" => 49, "nombre" => "Geometría y Figuras"],
            ["id" => 50, "nombre" => "Medidas y Unidades Avanzadas"],
            ["id" => 51, "nombre" => "Razonamiento Lógico"],
            ["id" => 52, "nombre" => "Velocidad Mental"],
            ["id" => 53, "nombre" => "Matemagia"],
            ["id" => 54, "nombre" => "Quiz de Matemáticas"],
            ["id" => 55, "nombre" => "Suma y Resta Avanzada"],
            ["id" => 56, "nombre" => "Multiplicaciones y Divisiones"],
            ["id" => 57, "nombre" => "Fracciones y Decimales"],
            ["id" => 58, "nombre" => "Problemas Matemáticos Complejos"],
            ["id" => 59, "nombre" => "Geometría y Figuras"],
            ["id" => 60, "nombre" => "Medidas y Unidades Avanzadas"],
            ["id" => 61, "nombre" => "Razonamiento Lógico"],
            ["id" => 62, "nombre" => "Velocidad Mental"],
            ["id" => 63, "nombre" => "Matemagia"],
            ["id" => 64, "nombre" => "Quiz de Matemáticas"],
            ["id" => 65, "nombre" => "Suma Avanzada Reto"],
            ["id" => 66, "nombre" => "Resta Avanzada Reto"],
            ["id" => 67, "nombre" => "Multiplicación Avanzada Reto"],
            ["id" => 68, "nombre" => "División Avanzada Reto"],
        ];

        foreach ($juegos as $juego) {
            Logro::insert([
                [
                    'titulo' => 'Explorador de ' . $juego['nombre'],
                    'descripcion' => 'Completa tu primer intento en ' . $juego['nombre'] . '. necesitas 20 puntos para desbloquear este logro.',
                    'icono' => 'fa-flag',
                    'puntos_requeridos' => 20,
                    'juego_id' => $juego['id'],
                ],
                [
                    'titulo' => 'Dominador de ' . $juego['nombre'],
                    'descripcion' => 'Alcanza 100 puntos o más en ' . $juego['nombre'] . '. necesitas 100 puntos para desbloquear este logro.',
                    'icono' => 'fa-star',
                    'puntos_requeridos' => 100,
                    'juego_id' => $juego['id'],
                ],
                [
                    'titulo' => 'Maestro de ' . $juego['nombre'],
                    'descripcion' => 'Consigue la puntuación máxima en ' . $juego['nombre'] . '. Necesitas 200 puntos para desbloquear este logro.',
                    'icono' => 'fa-trophy',
                    'puntos_requeridos' => 200,
                    'juego_id' => $juego['id'],
                ],


            ]);
        }
    }
}
