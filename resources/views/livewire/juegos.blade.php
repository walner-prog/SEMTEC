<div class="max-w-7xl mx-auto py-12 px-6">

    <!-- Título e Incentivos -->
   <div class="text-center mb-10 relative">

    <!-- Título con efecto vibrante -->
    <h1 class="text-5xl font-extrabold text-green-600 drop-shadow-lg animate-bounce-slow">
        🎮 Juegos Matemáticos
    </h1>

    <!-- Subtítulo animado -->
    <p class="text-gray-700 dark:text-gray-300 text-lg mt-3 animate-pulse">
        Aprende 📘, gana puntos ⭐, consigue trofeos 🏆 y desbloquea juegos 🔓
    </p>

    <!-- Panel de estadísticas con animaciones y colores -->
    <div class="flex justify-center gap-6 mt-6">

        <!-- Puntos -->
        <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-2xl shadow-lg transform hover:scale-110 transition-transform flex flex-col items-center animate-bounce">
            <i class="fa-solid fa-star text-yellow-500 text-3xl animate-spin-slow"></i>
            <span class="text-lg font-bold mt-1">{{ $puntos }} Puntos</span>
        </div>

        <!-- Monedas -->
        <div class="bg-orange-100 dark:bg-orange-900 p-4 rounded-2xl shadow-lg transform hover:scale-110 transition-transform flex flex-col items-center animate-bounce delay-75">
            <i class="fa-solid fa-coins text-orange-500 text-3xl animate-ping"></i>
            <span class="text-lg font-bold mt-1">{{ $monedas }} Monedas</span>
        </div>

        <!-- Trofeos -->
        <div class="bg-green-100 dark:bg-green-900 p-4 rounded-2xl shadow-lg transform hover:scale-110 transition-transform flex flex-col items-center animate-bounce delay-150">
            <i class="fa-solid fa-trophy text-green-500 text-3xl animate-bounce-slow"></i>
            <span class="text-lg font-bold mt-1">{{ $trofeos }} Trofeos</span>
        </div>

    </div>

    <!-- Confeti animado -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="animate-fall-slow">
            @for ($i = 0; $i < 15; $i++)
                <span class="absolute w-3 h-3 bg-yellow-400 rounded-full top-0 left-[{{ rand(0, 95) }}%] animate-fall-slow"></span>
            @endfor
        </div>
    </div>

</div>

<!-- Animaciones personalizadas Tailwind extendidas (puedes ponerlo en tu CSS) -->
<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow { animation: bounce-slow 2s infinite; }

    @keyframes spin-slow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-spin-slow { animation: spin-slow 4s linear infinite; }

    @keyframes fall-slow {
        0% { transform: translateY(-10px); opacity:1; }
        100% { transform: translateY(200px); opacity:0; }
    }
    .animate-fall-slow { animation: fall-slow 3s infinite; }
</style>



    <div class="fixed top-5 right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 20000)" x-show="show"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-20px] opacity-0"
            class="max-w-xs w-full border-l-4 border-{{ $color }}-500 bg-{{ $color }}-100 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200 p-4 rounded shadow-md flex items-start gap-2">
            <span class="font-semibold capitalize">{{ $type }}:</span>
            <span class="flex-1 text-sm">{{ session($type) }}</span>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        @endif
        @endforeach
    </div>


    <!-- Grid de Juegos -->
   <div class="grid md:grid-cols-3 gap-6">

    <!-- Juegos disponibles -->
    @foreach($juegosDisponibles as $juego)
    <div
        class="p-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-2xl shadow-lg border border-green-200 flex flex-col items-center transform hover:scale-105 transition-transform duration-300">

        <!-- Icono destacado -->
        <i class="fa-solid {{ $juego->icono }} text-5xl text-green-600 dark:text-green-300 drop-shadow-md"></i>

        <!-- Nombre del juego -->
        <h2 class="mt-4 font-bold text-lg text-green-700 dark:text-green-200 text-center">
            {{ $juego->nombre }}
        </h2>

        <!-- Descripción -->
        <p class="text-gray-600 dark:text-gray-300 text-sm mt-2 text-center">
            {{ $juego->descripcion }}    
        </p>

        <!-- Botones de reacción -->
        <div class="flex gap-4 mt-4 items-center">
            <button wire:click="reaccionar({{ $juego->id }}, 'me_gusta')"
                class="{{ $juego->reacciones->where('user_id', auth()->id())->where('tipo','me_gusta')->count() ? 'text-blue-500' : 'text-gray-400' }} hover:text-blue-600 transition">
                <i class="fa-solid fa-thumbs-up"></i> {{ $juego->me_gusta_count }}
            </button>

            <button wire:click="reaccionar({{ $juego->id }}, 'corazon')"
                class="{{ $juego->reacciones->where('user_id', auth()->id())->where('tipo','corazon')->count() ? 'text-red-500' : 'text-gray-400' }} hover:text-red-600 transition">
                <i class="fa-solid fa-heart"></i> {{ $juego->corazon_count }}
            </button> 

            <span class="text-gray-500 font-semibold ml-2"> Nivel: <strong class="text-green-700 dark:text-green-300">{{ $juego->nivel }}</strong> </span> 
        </div>

        <!-- Botón Jugar -->
        <button wire:click="abrirJuego({{ $juego->id }})"
            class="mt-4 px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition">
            Jugar ahora
        </button>
    </div>
    @endforeach

    <!-- Juegos bloqueados -->
    @foreach($juegosBloqueados as $juego)
    <div
        class="p-6 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 flex flex-col items-center relative">

        <i class="fa-solid {{ $juego->icono }} text-5xl text-gray-400 opacity-70"></i>

        <h2 class="mt-4 font-bold text-lg text-gray-500 text-center">
            {{ $juego->nombre }}
        </h2>

        <p class="text-gray-500 text-sm mt-2 text-center">
            {{ $juego->descripcion }}
        </p>

        <!-- Overlay de bloqueo -->
        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center rounded-2xl">
            <i class="fa-solid fa-lock text-3xl text-white mb-2"></i>
            <p class="text-white text-sm text-center">
                Necesitas {{ $juego->requisito_puntos ?? 0 }} ⭐ o {{ $juego->requisito_monedas ?? 0 }} 🪙
            </p>
        </div>
    </div>
    @endforeach

</div>


@if($modalAbierto)
<div x-data="{
    leerTexto(texto) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(texto);
            utterance.lang = 'es-ES';
            utterance.rate = 1;
            utterance.pitch = 1;
            window.speechSynthesis.speak(utterance);
        } else {
            alert('Tu navegador no soporta lectura de voz.');
        }
    }
}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl relative w-full max-w-6xl p-6 md:p-8 flex flex-col max-h-[90vh] overflow-hidden">

        <!-- Botón cerrar -->
        <button wire:click="cerrarModal"
            class="absolute top-5 right-5 text-gray-600 dark:text-gray-200 hover:text-red-500 text-3xl bg-white dark:bg-gray-800 rounded-full w-10 h-10 flex items-center justify-center shadow-md transition-all hover:scale-110">
            &times;
        </button>

        <div class="overflow-y-auto pr-2 flex-1">

            <!-- Encabezado -->
            <div class="text-center mb-6">
                <h2 class="text-4xl md:text-5xl font-black mb-2 text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-blue-500">
                    {{ $juegoSeleccionado->nombre }} <span class="text-5xl">🎮</span>
                </h2>
                <p class="text-gray-700 dark:text-gray-300 text-lg md:text-xl font-medium">
                    {{ $juegoSeleccionado->descripcion }}
                </p>
            </div>

            <!-- Barra de puntos + botones + iconos extras -->
            <div class="flex flex-wrap justify-center gap-4 mb-6 items-center">

                <!-- Puntos -->
                <div class="flex items-center gap-2 bg-yellow-100 dark:bg-yellow-800 px-4 py-2 rounded-full shadow hover:shadow-lg transition-shadow">
                    <i class="fa-solid fa-star text-yellow-500"></i>
                    <span class="text-yellow-700 dark:text-yellow-200">{{ $puntajeActual }}</span>
                </div>
                <div class="flex items-center gap-2 bg-yellow-100 dark:bg-yellow-800 px-4 py-2 rounded-full shadow hover:shadow-lg transition-shadow">
                    <i class="fa-solid fa-coins text-yellow-400"></i>
                    <span class="text-yellow-700 dark:text-yellow-200">{{ intval($puntajeActual / 2) }}</span>
                </div>

                <!-- Iconos futuros -->
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-bookmark text-blue-500 text-2xl cursor-pointer hover:scale-110 transition"></i>
                    <i class="fa-solid fa-share-nodes text-green-500 text-2xl cursor-pointer hover:scale-110 transition"></i>
                    <i class="fa-solid fa-trophy text-red-500 text-2xl cursor-pointer hover:scale-110 transition"></i>
                </div>

                <!-- Botón Pista -->
                <button wire:click="generarPista"
                        wire:loading.attr="disabled"
                        wire:target="generarPista"
                    class="flex items-center gap-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-full shadow-md transition-transform transform hover:scale-105 hover:shadow-lg">
                    💡 Pista
                </button>

                <!-- Botón Explicación -->
                <button wire:click="pedirExplicacion"
                        wire:loading.attr="disabled"
                        wire:target="pedirExplicacion"
                    class="flex items-center gap-2 px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-full shadow-md transition-transform transform hover:scale-105 hover:shadow-lg">
                    📝 Explicación
                </button>

            </div>

            @if($indicePregunta < count($preguntas))
            <div class="mb-4">

                <!-- Enunciado -->
                <div class="bg-blue-50 dark:bg-blue-900 p-5 rounded-2xl mb-6 shadow-md flex items-center justify-between">
                    <p class="text-gray-800 dark:text-gray-200 text-xl md:text-2xl font-medium text-center flex-1">
                        {{ $preguntas[$indicePregunta]['enunciado'] }}
                    </p>
                    <button @click="leerTexto(@js($preguntas[$indicePregunta]['enunciado']))"
                        class="ml-4 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-md transition-transform hover:scale-110">
                        🔊 Escuchar
                    </button>
                </div>

                <!-- Opciones -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(json_decode($preguntas[$indicePregunta]['opciones']) as $index => $opcion)
                    <button wire:click="responder('{{ $opcion }}')"
                        class="w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-green-300 dark:border-green-600 rounded-2xl font-bold text-lg shadow-md transition-all duration-300 hover:scale-100 hover:bg-green-50 dark:hover:bg-green-700 flex items-center justify-center gap-3">
                        <span class="text-xl rounded-full w-8 h-8 flex items-center justify-center bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-200">
                            {{ chr(65 + $index) }}
                        </span>
                        {{ $opcion }}
                    </button>
                    @endforeach
                </div>

                <!-- Feedback respuesta -->
               
@if(!is_null($respuestaCorrecta))
    <div class="my-4 flex items-center justify-center gap-3 text-xl font-bold animate-fade-in">
        @if($respuestaCorrecta)
            <i class="fa-solid fa-circle-check text-green-500 text-3xl"></i>
        @else
            <i class="fa-solid fa-circle-xmark text-red-500 text-3xl"></i>
        @endif
        <span>{{ $mensajeMotivador }}</span>
    </div>
@endif
@if($mensajeFinal)
    <div class="my-4 flex items-center justify-center gap-3 text-xl font-bold animate-fade-in">
        <span>{{ $mensajeFinal }}</span>
    </div>
@endif


                <!-- Pista -->
                <div wire:loading.flex wire:target="generarPista" class="mt-4 justify-center">
                    <div class="flex items-center gap-2 px-4 py-2 bg-yellow-100 dark:bg-yellow-800 rounded-2xl shadow-md">
                        <i class="fa-solid fa-spinner fa-spin text-yellow-600"></i>
                        <span class="text-yellow-700 dark:text-yellow-200">Consultando pista...</span>
                    </div>
                </div>
                @if($pistaIA)
                <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex justify-between items-center">
                    <p class="text-yellow-800 dark:text-yellow-200 font-medium flex-1">{{ $pistaIA }}</p>
                    <button @click="leerTexto(@js($pistaIA))"
                        class="ml-4 px-4 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-md transition-transform hover:scale-105">
                        🔊
                    </button>
                </div>
                @endif

                <!-- Explicación -->
                <div wire:loading.flex wire:target="pedirExplicacion" class="mt-4 justify-center">
                    <div class="flex items-center gap-2 px-4 py-2 bg-purple-100 dark:bg-purple-800 rounded-2xl shadow-md">
                        <i class="fa-solid fa-spinner fa-spin text-purple-600"></i>
                        <span class="text-purple-700 dark:text-purple-200">Consultando explicación...</span>
                    </div>
                </div>
                @if($explicacionIA)
                <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex justify-between items-center">
                    <p class="text-purple-800 dark:text-purple-200 font-medium flex-1">{{ $explicacionIA }}</p>
                    <button @click="leerTexto(@js($explicacionIA))"
                        class="ml-4 px-4 py-1 bg-purple-500 hover:bg-purple-600 text-white rounded-full shadow-md transition-transform hover:scale-105">
                        🔊
                    </button>
                </div>
                @endif

            </div>
            @endif

        </div>
    </div>
</div>
@endif





 



</div>