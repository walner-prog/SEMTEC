<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Misión</title>
</head>

<body>

    <x-app-layout>


        <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">

<main class="flex-grow bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
        dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen transition-colors">

    <div class="max-w-7xl mx-auto py-12 px-6">

        <!-- Título -->
        <h1 class="text-5xl font-extrabold text-center text-blue-800 dark:text-blue-300 mb-12 drop-shadow-xl animate-pulse">
            🌟 Nuestra Misión
        </h1>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Columna 1: Texto -->
            <div class="space-y-6 text-lg">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    En su esencia, nuestra misión es
                    <span class="font-bold text-blue-700 dark:text-blue-400 animate-bounce">democratizar la educación matemática</span>
                    a través de una plataforma innovadora que integra
                    <i class="fa-solid fa-hands-asl-interpreting text-purple-600 dark:text-purple-400 animate-spin-slow"></i>
                    lenguaje de señas y tecnología.
                </p>

                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Este propósito nace de la comprensión de un problema social sistémico:
                    la enseñanza tradicional de las matemáticas ha sido históricamente
                    inaccesible para estudiantes con discapacidad auditiva.
                    <span class="font-bold text-pink-600 dark:text-pink-400 animate-bounce">SEMTEC existe para corregir esta injusticia</span>.
                </p>

                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Al proporcionar herramientas que devuelven el control sobre su educación,
                    fomentamos no solo el aprendizaje académico, sino también
                    <i class="fa-solid fa-bolt text-yellow-500 animate-ping"></i>
                    la confianza en su capacidad para superar obstáculos.
                </p>

                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Nuestra misión se ejecuta en
                    <i class="fa-solid fa-people-group text-green-600 dark:text-green-400 animate-bounce"></i>
                    colaboración constante con la comunidad educativa,
                    adaptando contenidos y tecnologías a necesidades reales.
                </p>
            </div>

            <!-- Columna 2: Ilustración con íconos grandes y animaciones -->
            <div class="flex flex-col items-center justify-center space-y-8">
                <div class="w-40 h-40 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-400 to-purple-500 text-white text-6xl shadow-2xl transform hover:scale-110 transition-transform animate-bounce-slow">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>

                <div class="w-32 h-32 flex items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-teal-500 text-white text-5xl shadow-lg transform hover:-translate-y-2 transition-transform animate-pulse-slow">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>

                <div class="w-28 h-28 flex items-center justify-center rounded-full bg-gradient-to-bl from-pink-400 to-red-500 text-white text-4xl shadow-md transform hover:rotate-3 transition-transform animate-spin-slow">
                    <i class="fa-solid fa-book-open"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-6">

        <h1 class="text-4xl font-bold text-blue-800 mb-10 text-center drop-shadow-lg">🎯 Objetivos SMART</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @php
                $objetivos = [
                    ['icon'=>'fa-bullseye','color'=>'blue','title'=>'Specific / Específico','text'=>'Lograr 2000 descargas...'],
                    ['icon'=>'fa-chart-line','color'=>'green','title'=>'Measurable / Medible','text'=>'Incrementar la tasa de retención...'],
                    ['icon'=>'fa-rocket','color'=>'yellow','title'=>'Achievable / Alcanzable','text'=>'Desarrollar y publicar 50 nuevas lecciones...'],
                    ['icon'=>'fa-handshake','color'=>'purple','title'=>'Relevant / Relevante','text'=>'Establecer 3 alianzas estratégicas...'],
                    ['icon'=>'fa-clock','color'=>'red','title'=>'Time-based / Con límite de tiempo','text'=>'Asegurar un financiamiento inicial...','span'=>2],
                ];
            @endphp

            @foreach($objetivos as $obj)
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border-l-8 border-{{ $obj['color'] }}-500 hover:shadow-2xl transition-all transform hover:-translate-y-2">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fa-solid {{ $obj['icon'] }} text-3xl text-{{ $obj['color'] }}-500 animate-bounce-slow"></i>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $obj['title'] }}</h2>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $obj['text'] }}</p>
                </div>
            @endforeach

        </div>
    </div>

</main>





        </div>
        </div>
    </x-app-layout>

</body>

</html>