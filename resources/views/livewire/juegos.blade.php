<div class="max-w-7xl mx-auto py-12 px-6">

    <!-- Título e Incentivos -->
  <div class="text-center mb-10 relative px-4 sm:px-0">

    <!-- Título con efecto vibrante -->
    <h1 class="text-3xl sm:text-5xl font-extrabold text-green-600 drop-shadow-lg animate-bounce-slow">
        🎮 Juegos Matemáticos
    </h1>

    <!-- Subtítulo animado -->
    <p class="text-gray-700 dark:text-gray-300 text-sm sm:text-lg mt-3 animate-pulse">
        Aprende 📘, gana puntos ⭐, consigue trofeos 🏆 y desbloquea juegos 🔓
    </p>

    <!-- Panel de estadísticas con animaciones y colores -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 mt-6">

        <!-- Puntos -->
        <div class="bg-yellow-100 dark:bg-yellow-900 p-4 sm:p-6 rounded-2xl shadow-lg transform hover:scale-105 transition-transform flex flex-col items-center animate-bounce">
            <i class="fa-solid fa-star text-yellow-500 text-2xl sm:text-3xl animate-spin-slow"></i>
            <span class="text-sm sm:text-lg font-bold mt-1">{{ $puntos }} Puntos</span>
        </div>

        <!-- Monedas -->
        <div class="bg-orange-100 dark:bg-orange-900 p-4 sm:p-6 rounded-2xl shadow-lg transform hover:scale-105 transition-transform flex flex-col items-center animate-bounce delay-75">
            <i class="fa-solid fa-coins text-orange-500 text-2xl sm:text-3xl animate-ping"></i>
            <span class="text-sm sm:text-lg font-bold mt-1">{{ $monedas }} Monedas</span>
        </div>

        <!-- Trofeos -->
        <div class="bg-green-100 dark:bg-green-900 p-4 sm:p-6 rounded-2xl shadow-lg transform hover:scale-105 transition-transform flex flex-col items-center animate-bounce delay-150">
            <i class="fa-solid fa-trophy text-green-500 text-2xl sm:text-3xl animate-bounce-slow"></i>
            <span class="text-sm sm:text-lg font-bold mt-1">{{ $trofeos }} Trofeos</span>
        </div>

    </div>

    <!-- Confeti animado -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        @for ($i = 0; $i < 15; $i++)
            <span class="absolute w-2 h-2 sm:w-3 sm:h-3 bg-yellow-400 rounded-full top-0 left-[{{ rand(0, 95) }}%] animate-fall-slow"></span>
        @endfor
    </div>

</div>


    <!-- Animaciones personalizadas Tailwind extendidas (puedes ponerlo en tu CSS) -->
    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite;
        }

        @keyframes spin-slow {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 4s linear infinite;
        }

        @keyframes fall-slow {
            0% {
                transform: translateY(-10px);
                opacity: 1;
            }

            100% {
                transform: translateY(200px);
                opacity: 0;
            }
        }

        .animate-fall-slow {
            animation: fall-slow 3s infinite;
        }

    </style>



    <div class="fixed top-5  right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 20000)" x-show="show" x-transition:enter="transform ease-out duration-300" x-transition:enter-start="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-[-20px] opacity-0" class="max-w-xs w-full border-l-4 border-{{ $color }}-500 bg-{{ $color }}-100 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200 p-4 rounded shadow-md flex items-start gap-2">
            <span class="font-semibold capitalize">{{ $type }}:</span>
            <span class="flex-1 text-sm">{{ session($type) }}</span>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        @endif
        @endforeach
    </div>


    <!-- Grid de Juegos -->
    <section aria-labelledby="games-heading" class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
    <!-- Título -->
    <h2 id="games-heading" class="text-3xl font-bold text-gray-900 dark:text-slate-100">
        Juegos Disponibles
    </h2>

    <!-- Filtros -->
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <select wire:model.live="categoriaSeleccionada" class="w-full sm:w-auto px-4 py-2 rounded-xl border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-700 dark:text-slate-100">
            <option value="">Todas las Categorías</option>
            @foreach($categorias as $cat)
            <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>

        @if($categoriaSeleccionada)
        <button wire:click="$set('categoriaSeleccionada', '')" class="w-full sm:w-auto px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-all">
            Limpiar Filtro
        </button>
        @endif
    </div>
</div>



        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($juegosDisponibles as $juego)
            <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-emerald-200 dark:border-emerald-900 hover:border-emerald-500 dark:hover:border-emerald-400 transition-all shadow-lg hover:shadow-2xl">

                <!-- Header con icono y XP -->
                <div class="flex items-start justify-between mb-4">
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900 rounded-2xl flex items-center justify-center">
                        <i class="fa-solid {{ $juego->icono }} text-4xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold">
                        Nivel {{ $juego->nivel }}
                    </span>
                </div>

                <!-- Nombre -->
                <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2 text-center">
                    {{ $juego->nombre }}
                </h3>

                <!-- Descripción -->
                <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed text-center">
                    {{ $juego->descripcion }}
                </p>

                <!-- 🔹 Progreso del usuario -->
                <div class="flex flex-col gap-2 mt-4 text-center">

                    <div class="flex justify-center gap-4 text-sm text-gray-700 dark:text-gray-300">
                        <span>🔥 Racha: <strong>{{ $juego->racha_actual }}</strong></span>
                        <span>🏅 Máxima: <strong>{{ $juego->racha_maxima }}</strong></span>
                        <span>📅 Días jugados: <strong>{{ $juego->dias_jugados }}</strong></span>
                    </div>

                    <!-- Logros obtenidos -->
                    @if(count($juego->logros_obtenidos))
                    <div class="flex justify-center gap-2 flex-wrap mt-2">
                        @foreach($juego->logros_obtenidos as $logro)
                         {{--   <span class="bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 px-3 py-1 rounded-full text-xs font-semibold shadow">
                            {{ $logro->titulo }}
                        </span> --}}
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Reacciones -->
                <div class="flex justify-center gap-6 mb-4 text-gray-500 dark:text-gray-300">
                    <button wire:click="reaccionar({{ $juego->id }}, 'me_gusta')" class="flex items-center gap-2 transition {{ $juego->reacciones->where('user_id', auth()->id())->where('tipo','me_gusta')->count() ? 'text-blue-500' : 'hover:text-blue-500' }}">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>{{ $juego->me_gusta_count }}</span>
                    </button>

                    <button wire:click="reaccionar({{ $juego->id }}, 'corazon')" class="flex items-center gap-2 transition {{ $juego->reacciones->where('user_id', auth()->id())->where('tipo','corazon')->count() ? 'text-rose-500' : 'hover:text-rose-500' }}">
                        <i class="fa-solid fa-heart"></i>
                        <span>{{ $juego->corazon_count }}</span>
                    </button>
                </div>

                <!-- Botón Jugar -->
                <button wire:click="abrirJuego({{ $juego->id }})" class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                    <i class="fa-solid fa-play mr-2"></i> ¡Jugar Ahora!
                </button>
            </article>
            @endforeach

            <!-- Juegos Bloqueados -->
            @foreach($juegosBloqueados as $juego)
            <article class="relative bg-gray-100 dark:bg-slate-800 rounded-3xl p-6 border-4 border-gray-300 dark:border-slate-700 shadow-lg flex flex-col items-center justify-center opacity-70">

                <i class="fa-solid {{ $juego->icono }} text-5xl text-gray-400 mb-3"></i>
                <h3 class="text-xl font-semibold text-gray-500 text-center">{{ $juego->nombre }}</h3>
                <p class="text-gray-500 text-sm text-center mt-2">{{ $juego->descripcion }}</p>

                <!-- Overlay bloqueado -->
                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-3xl flex flex-col items-center justify-center text-white backdrop-blur-sm">
                    <i class="fa-solid fa-lock text-3xl mb-2"></i>
                    <p class="text-center text-sm">
                        Desbloquea con <strong>{{ $juego->requisito_puntos ?? 0 }} ⭐</strong> o
                        <strong>{{ $juego->requisito_monedas ?? 0 }} 🪙</strong>
                    </p>
                </div>
            </article>
            @endforeach
        </div>

    </section>

    <style>
        .high-contrast {
            background-color: black !important;
            color: yellow !important;
        }

        .high-contrast button {
            background-color: yellow !important;
            color: black !important;
            border-color: black !important;
        }

    </style>


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
        }" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">

           <div class="bg-gradient-to-b from-blue-200 to-white dark:from-blue-900 dark:to-gray-900 rounded-3xl shadow-2xl relative w-full max-w-3xl p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <div class="fixed bottom-5 right-5 flex flex-col gap-2 z-50">
                <button @click="document.documentElement.style.fontSize = (parseInt(getComputedStyle(document.documentElement).fontSize)+2)+'px'" class="px-3 py-2 bg-blue-500 text-white rounded-full shadow-md hover:bg-blue-600">A+</button>
                <button @click="document.documentElement.style.fontSize = (parseInt(getComputedStyle(document.documentElement).fontSize)-2)+'px'" class="px-3 py-2 bg-blue-500 text-white rounded-full shadow-md hover:bg-blue-600">A-</button>
                <button @click="document.body.classList.toggle('high-contrast')" class="px-3 py-2 bg-yellow-500 text-black rounded-full shadow-md hover:bg-yellow-600">⚡
                    Contraste</button>
            </div>

            <!-- Botón cerrar -->
            <button wire:click="cerrarModal" class="absolute top-5 right-5 text-gray-700 dark:text-gray-200 hover:text-red-500 text-3xl bg-white dark:bg-gray-800 rounded-full w-10 h-10 flex items-center justify-center shadow-md transition-all hover:scale-110 animate-bounce">
                &times;
            </button>


            <div class="text-center mb-6">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-white animate-pulse">
                    {{ $juegoSeleccionado->nombre }} <span class="text-5xl animate-bounce">🇳🇮</span>
                </h2>
                <p class="text-gray-700 dark:text-gray-300 text-lg md:text-xl font-medium">
                    {{ $juegoSeleccionado->descripcion }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $this->diasDesdeUltimaPartida($juego->id) }}
                </p>

                <!-- 🔹 Progreso del usuario (compacto) -->
                <div class="flex flex-col gap-1 mt-3 text-center text-sm text-gray-700 dark:text-gray-300">
                    <div class="flex justify-center gap-3">
                        <span>🔥 Racha: <strong>{{ $juegoSeleccionado->racha_actual }}</strong></span>
                        <span>🏅 Máxima: <strong>{{ $juegoSeleccionado->racha_maxima }}</strong></span>
                        <span>📅 Días jugados: <strong>{{ $juegoSeleccionado->dias_jugados }}</strong></span>
                    </div>

                    <!-- Logros obtenidos con colores -->
                    <h3 class="text-lg font-semibold mb-1">Logros Obtenidos:</h3>

                    @if($juegoSeleccionado->logros_obtenidos && $juegoSeleccionado->logros_obtenidos->isNotEmpty())
                    <div class="flex justify-center gap-2 flex-wrap mt-2">
                        @foreach($juegoSeleccionado->logros_obtenidos as $index => $logro)
                        @php
                        // Definir colores según el índice del logro
                        $colores = [
                        ['bg' => 'bg-yellow-100 dark:bg-yellow-800', 'text' => 'text-yellow-900 dark:text-yellow-200',
                        'icon' => 'text-yellow-600 dark:text-yellow-300'],
                        ['bg' => 'bg-green-100 dark:bg-green-800', 'text' => 'text-green-800 dark:text-green-200',
                        'icon' => 'text-green-600 dark:text-green-300'],
                        ['bg' => 'bg-blue-100 dark:bg-blue-800', 'text' => 'text-blue-800 dark:text-blue-200', 'icon' =>
                        'text-blue-600 dark:text-blue-300'],
                        ];
                        $color = $colores[$index % count($colores)];
                        @endphp

                        <span class="{{ $color['bg'] }} {{ $color['text'] }} px-2 py-0.5 rounded-full text-xs font-semibold shadow flex items-center gap-1">
                            <i class="fa {{ $logro->icono }} {{ $color['icon'] }}"></i>
                            {{ $logro->titulo }}
                        </span>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Sin logros aún</p>
                    @endif



                </div>
            </div>


            <!-- Barra de puntaje y botones nica -->
            <div class="flex flex-wrap justify-center gap-4 mb-6 items-center">

                <!-- Puntaje estilo “rayito de sol” -->
                <div class="flex items-center gap-2 bg-yellow-100 dark:bg-yellow-800 px-4 py-2 rounded-full shadow-lg animate-pulse hover:shadow-xl">
                    <i class="fa-solid fa-star text-yellow-500 text-2xl animate-ping"></i>
                    <span class="text-yellow-700 dark:text-yellow-200 font-bold">{{ $puntajeActual }}</span>
                </div>

                <div class="flex items-center gap-2 bg-green-100 dark:bg-green-800 px-4 py-2 rounded-full shadow-lg animate-pulse hover:shadow-xl">
                    <i class="fa-solid fa-coins text-yellow-400 text-2xl animate-ping"></i>
                    <span class="text-yellow-700 dark:text-yellow-200 font-bold">{{ intval($puntajeActual / 2) }}</span>
                </div>

                <!-- Iconos extras -->
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-bookmark text-blue-500 text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
                    <i class="fa-solid fa-share-nodes text-green-500 text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
                    <i class="fa-solid fa-trophy text-red-500 text-2xl cursor-pointer hover:scale-110 transition-transform"></i>
                </div>

                <!-- Botones nicas -->
                <button wire:click="generarPista" wire:loading.attr="disabled" wire:target="generarPista" class="flex items-center gap-2 px-5 py-3 bg-blue-500 hover:bg-yellow-400 text-white font-bold rounded-full shadow-md text-xl transform hover:scale-110 transition-all">
                    💡 Pista 🌽
                </button>

                <button wire:click="pedirExplicacion" wire:loading.attr="disabled" wire:target="pedirExplicacion" class="flex items-center gap-2 px-5 py-3 bg-purple-500 hover:bg-indigo-400 text-white font-bold rounded-full shadow-md text-xl transform hover:scale-110 transition-all">
                    📝 Explicación 🏝️
                </button>

            </div>

            @if($indicePregunta < count($preguntas)) <div class="mb-4">

                <!-- Enunciado -->
                <div class="bg-blue-50 dark:bg-blue-900 p-5 rounded-2xl mb-6 shadow-md flex items-center justify-between">
                    <p class="text-gray-800 dark:text-gray-200 text-xl md:text-2xl font-medium text-center flex-1">
                        {{ $preguntas[$indicePregunta]['enunciado'] }}
                    </p>
                    <button @click="leerTexto(@js($preguntas[$indicePregunta]['enunciado']))" class="ml-4 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-md text-lg transform hover:scale-125 transition-all">
                        🔊 Escuchar
                    </button>
                </div>

                <!-- Opciones estilo nica -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                    @foreach(json_decode($preguntas[$indicePregunta]['opciones']) as $index => $opcion)
                    <button wire:click="responder('{{ $opcion }}')" class="w-full px-5 py-4 bg-white dark:text-gray-300 dark:bg-gray-800 border-2 border-blue-400 dark:border-blue-600 rounded-2xl font-bold text-lg shadow-md transition-transform hover:scale-105 hover:bg-blue-50 dark:hover:bg-blue-700 flex items-center justify-center gap-3">
                        <span class="text-xl rounded-full w-10 h-10 flex items-center justify-center bg-gradient-to-tr from-yellow-300 to-blue-300 text-white shadow-lg animate-bounce">
                            {{ chr(65 + $index) }}
                        </span>
                        {{ $opcion }}
                    </button>
                    @endforeach
                </div>

                <!-- Feedback nica -->
                @if(!is_null($respuestaCorrecta))
                <div class="my-4 flex items-center justify-center gap-3 text-xl font-bold animate-fade-in">
                    @if($respuestaCorrecta)
                    <div class="flex items-center gap-3 dark:text-gray-300  bg-green-100 dark:bg-green-800 px-4 py-2 rounded-2xl shadow-lg">
                        <i class="fa-solid fa-circle-check text-green-500 text-3xl"></i>
                        <span class="dark:text-gray-300">¡Bien hecho, campeón nica! 🎉 {{ $mensajeMotivador }}</span>
                    </div>
                    @else
                    <div class="flex items-center gap-3 dark:text-gray-300  bg-red-100 dark:bg-red-800 px-4 py-2 rounded-2xl shadow-lg">
                        <i class="fa-solid fa-circle-xmark text-red-500 text-3xl"></i>
                        <span class="dark:text-gray-300 ">¡No te rindas, la próxima va con más fuerza! 💪 {{
                            $mensajeMotivador }}</span>
                    </div>
                    @endif
                </div>
                @endif

                @if($mensajeFinal)
                <div class="my-4 flex items-center dark:text-gray-300  justify-center gap-3 text-xl font-bold animate-fade-in">
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
                    <button @click="leerTexto(@js($pistaIA))" class="ml-4 px-4 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-md transition-transform hover:scale-105">
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
                    <button @click="leerTexto(@js($explicacionIA))" class="ml-4 px-4 py-1 bg-purple-500 hover:bg-purple-600 text-white rounded-full shadow-md transition-transform hover:scale-105">
                        🔊
                    </button>
                </div>
                @endif

        </div>
        @endif

      </div>
     </div>




@endif




</div>
