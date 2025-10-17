<div>
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">
        Actividades disponibles
    </h2>


    <div class="fixed top-5 right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-20px] opacity-0"
            class="max-w-xs w-full border-l-4 border-{{ $color }}-500 bg-{{ $color }}-100 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200 p-4 rounded shadow-md flex items-start gap-2">
            <i class="fas fa-info-circle text-{{ $color }}-600 mt-1"></i>
            <div class="flex-1">
                <span class="font-semibold capitalize">{{ $type }}:</span>
                <span class="text-sm">{{ session($type) }}</span>
            </div>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        @endif
        @endforeach
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
            dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">


        <div class="lg:col-span-9">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fas fa-tasks text-blue-500"></i> Actividades Disponibles
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                @forelse($actividades as $actividad)
                <div
                    class="bg-gradient-to-r from-green-100 to-green-200 dark:from-green-700 dark:to-green-800 
                           rounded-xl shadow-lg hover:shadow-xl transition p-4 flex flex-col justify-between border border-green-300 dark:border-green-600">
                    <h3 class="text-lg font-bold text-green-800 dark:text-green-100 mb-2 flex items-center gap-2">
                        <i class="fas fa-book-open"></i> {{ $actividad->titulo }}
                    </h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                        {{ Str::limit($actividad->objetivo, 60) }}
                    </p>
                    <button wire:click="abrirActividad({{ $actividad->id }})"
                        class="mt-auto px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md flex items-center gap-2">
                        <i class="fas fa-rocket"></i> Empezar
                    </button>
                </div>
                @empty
                <p class="text-center col-span-3 text-gray-600 dark:text-gray-400">No hay actividades pendientes 🎉</p>
                @endforelse
            </div>
        </div>



        <div class="lg:col-span-3 flex flex-col gap-6">

            <h2 class="text-2xl font-bold  text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fas fa-tasks text-blue-500"></i> Mas Secciones
            </h2>


            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <i class="fas fa-robot text-purple-500"></i> Aprende con IA
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Descubre cómo la inteligencia artificial puede personalizar tus estudios y ayudarte a mejorar en
                    cada reto .
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-magic text-pink-500"></i>
                        <span class="text-gray-700 dark:text-gray-300">Explicaciones interactivas</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-headphones text-blue-500"></i>
                        <span class="text-gray-700 dark:text-gray-300">Lectura en voz</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-language text-green-500"></i>
                        <span class="text-gray-700 dark:text-gray-300">Traducciones rápidas</span>
                    </li>
                </ul>
                <button wire:click="$dispatch('abrirModalIA', { userId: {{ Auth::id() }} })"
                    class="mt-4 w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow flex items-center justify-center gap-2">
                    <i class="fas fa-brain"></i> Probar IA
                </button>


                @livewire('interaccion-i-a')


            </div>

            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-400"></i> Noticias & Tips
                </h3>
                <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-bolt text-orange-500"></i>
                        Nuevo reto matemático disponible 🎯
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-award text-green-500"></i>
                        Consigue un trofeo completando 5 actividades
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-heart text-red-500"></i>
                        Cuida tu progreso: estudia un poco cada día 
                    </li>
                </ul>
            </div>
        </div>



        <div class="lg:col-span-12">
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <i class="fas fa-chart-line text-blue-500"></i> Progreso General
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Sigue avanzando, estás logrando grandes resultados 🚀
                    </p>
                    <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div class="bg-blue-600 h-3 rounded-full" style="width: 65%"></div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">65% de avance</p>
                </div>

                <div class="flex gap-6">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        <span class="text-gray-700 dark:text-gray-200 font-bold">12</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Completadas</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <i class="fas fa-hourglass-half text-yellow-500 text-2xl"></i>
                        <span class="text-gray-700 dark:text-gray-200 font-bold">5</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Pendientes</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <i class="fas fa-trophy text-purple-500 text-2xl"></i>
                        <span class="text-gray-700 dark:text-gray-200 font-bold">3</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Trofeos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="hidden md:block">


        @if($mostrarModal && $actividadSeleccionada)
        <div x-data="{ open: true, showConfetti: false, darkMode: {{ $highContrast ? 'true' : 'false' }} }"
            x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto">


            <div class="rounded-3xl  bg-gray-100  dark:bg-gray-900 shadow-2xl w-full max-w-3xl max-h-[95vh] overflow-y-auto p-6 relative transition-colors duration-300"
                style="font-size: {{ $fontSize }}px;">

                @if($accesibilidad['isn'])
                <div class="mb-4 flex justify-center items-center gap-3 flex-wrap text-lg">
                    <span class="font-semibold flex dark:text-gray-200 items-center gap-2"><i
                            class="fas fa-universal-access text-2xl"></i>
                        Ajustes:</span>
                    <button wire:click="disminuirFont"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-minus-circle text-xl"></i> A-
                    </button>
                    <button wire:click="aumentarFont"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-plus-circle text-xl"></i> A+
                    </button>
                    <button @click="darkMode = !darkMode" wire:click="toggleHighContrast"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-adjust text-xl"></i> Contraste
                    </button>
                </div>
                @endif

                <!-- Título actividad -->
                <div class="text-center mb-6">
                    <h3
                        class="font-extrabold text-3xl md:text-4xl text-blue-600 flex items-center justify-center gap-3">
                        <i class="fas fa-gamepad text-4xl"></i> {{ $actividadSeleccionada->titulo }}
                    </h3>
                    <p class="text-lg md:text-xl text-green-700 font-semibold mt-3">
                        <i class="fas fa-bullseye text-2xl"></i> {{ $actividadSeleccionada->objetivo }}
                    </p>
                </div>

                <!-- Multimedia -->
                @if($actividadSeleccionada->media_video || $actividadSeleccionada->media_documento)
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($actividadSeleccionada->media_video)
                    @php
                    $videoUrl = $actividadSeleccionada->media_video;
                    $embedType = 'file';
                    if(Str::contains($videoUrl,'youtube.com/watch')) {
                    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                    $videoUrl = isset($query['v']) ? 'https://www.youtube.com/embed/'.$query['v'] : $videoUrl;
                    $embedType='youtube';
                    } elseif(Str::contains($videoUrl,'youtu.be/')) {
                    $videoId = last(explode('/',$videoUrl));
                    $videoUrl = 'https://www.youtube.com/embed/'.$videoId;
                    $embedType='youtube';
                    } elseif(Str::contains($videoUrl,'vimeo.com/')) {
                    $videoId = preg_replace('/[^0-9]/','',$videoUrl);
                    $videoUrl='https://player.vimeo.com/video/'.$videoId;
                    $embedType='vimeo';
                    } elseif(!Str::endsWith($videoUrl,['.mp4','.webm','.ogg'])) {
                    $embedType='link';
                    }
                    @endphp
                    <div class="mb-4 rounded-xl overflow-hidden shadow-lg animate-fadeIn">
                        @if($embedType==='youtube' || $embedType==='vimeo')
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $videoUrl }}" class="w-full h-64 md:h-80 rounded-lg shadow-lg"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                        @elseif($embedType==='file')
                        <video controls class="w-full rounded-lg shadow-lg">
                            <source src="{{ $videoUrl }}" type="video/mp4">Tu navegador no soporta video.
                        </video>
                        @else
                        <a href="{{ $videoUrl }}" target="_blank" class="text-blue-600 underline font-bold">📺 Ver
                            video</a>
                        @endif
                    </div>
                    @endif

                    @if($actividadSeleccionada->media_documento)
                    @php
                    $docUrl=$actividadSeleccionada->media_documento;
                    $ext=strtolower(pathinfo(parse_url($docUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                    @endphp
                    <div class="mb-4 rounded-xl overflow-hidden shadow-lg animate-fadeIn">
                        @if($ext==='pdf')
                        <iframe src="{{ $docUrl }}" class="w-full h-64 md:h-80 rounded-lg shadow-lg"></iframe>
                        @else
                        <a href="{{ $docUrl }}" target="_blank"
                            class="text-blue-600 underline font-bold flex items-center gap-2">
                            📂 Abrir {{ strtoupper($ext) }}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
                @endif

                @if(!$actividadFinalizada)
                <!-- Progreso -->
                <div class="mb-6 flex justify-center flex-wrap gap-3">
                    @foreach(range(1,count($items)) as $i)
                    <div
                        class="w-12 h-12 text-lg rounded-full flex items-center justify-center 
                {{ $i<=$itemIndex ? 'bg-green-500 text-white shadow-lg animate-bounce' : 'bg-gray-300 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $i }}
                    </div>
                    @endforeach
                </div>

                <!-- Pregunta -->
                <div class="p-6 bg-gradient-to-r from-green-200 via-blue-200 to-green-300 
           dark:from-gray-800 dark:via-gray-800 dark:to-gray-800 
           dark:text-gray-200 rounded-3xl shadow-xl text-center mb-6">

                    {{-- 🔊 Botón de lectura en voz alta --}}
                    @if($accesibilidad['tts'])
                    <button wire:click="leerEnunciado" class="px-5 py-2 bg-blue-500 text-white rounded-full mb-4 
                   hover:bg-blue-600 transition shadow-md flex items-center gap-2 mx-auto">
                        <i class="fas fa-volume-up text-xl"></i> Escuchar
                    </button>
                    @endif

                    {{-- 🧩 Título y pregunta --}}
                    <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-3 
               flex items-center justify-center gap-2 text-xl md:text-2xl">
                        <i class="fas fa-question-circle text-2xl"></i> Pregunta {{ $itemIndex + 1 }}
                    </h4>

                    <p class="text-gray-800 dark:text-gray-200 mb-5 text-lg md:text-xl leading-relaxed">
                        {{ $items[$itemIndex]['enunciado'] }}
                    </p>

                    {{-- 💡 Botones de ayuda IA --}}
                    <div class="flex justify-center gap-4 mb-5 flex-wrap">
                        <button wire:click="generarPista" class="px-5 py-3 bg-purple-500 hover:bg-purple-600 text-white font-bold 
                   rounded-full shadow-md transition flex items-center gap-2 text-lg">
                            <i class="fas fa-lightbulb text-2xl"></i> Pista
                        </button>
                        <button wire:click="pedirExplicacion" class="px-5 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-bold 
                   rounded-full shadow-md transition flex items-center gap-2 text-lg">
                            <i class="fas fa-book-open text-2xl"></i> Explicación
                        </button>
                    </div>

                    {{-- 📘 Resultados IA --}}
                    @if($pistaIA)
                    <div class="mb-3 p-3 bg-purple-100 dark:bg-purple-900 
                    text-purple-800 dark:text-purple-200 
                    rounded-xl shadow-md text-left">
                        <i class="fas fa-info-circle"></i>
                        <strong>Pista:</strong> {{ $pistaIA }}
                    </div>
                    @endif

                    @if($explicacionIA)
                    <div class="mb-3 p-3 bg-indigo-100 dark:bg-indigo-900 
                    text-indigo-800 dark:text-indigo-200 
                    rounded-xl shadow-md text-left">
                        <i class="fas fa-book"></i>
                        <strong>Explicación:</strong> {{ $explicacionIA }}
                    </div>
                    @endif

                    @if(isset($items[$itemIndex]['datos']['opciones']))
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        @foreach($items[$itemIndex]['datos']['opciones'] as $opcion)
                        @php
                        // Colores cíclicos para las opciones
                        $colores = [
                        'from-blue-400 to-blue-600 border-blue-600',
                        'from-green-400 to-green-600 border-green-600',
                        'from-purple-400 to-purple-600 border-purple-600',
                        'from-yellow-400 to-yellow-600 border-yellow-600',
                        'from-pink-400 to-pink-600 border-pink-600',
                        'from-orange-400 to-orange-600 border-orange-600',
                        ];
                        $color = $colores[$loop->index % count($colores)];
                        @endphp

                        <button wire:click="$set('respuesta', '{{ $opcion }}')"
                            class="relative overflow-hidden p-4 text-lg font-semibold rounded-2xl border-4 shadow-md
                       transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none
                       {{ $respuesta === $opcion 
                            ? ($respuesta == $items[$itemIndex]['respuesta'] 
                                ? 'bg-green-500 border-green-700 text-white scale-105 shadow-lg ring-4 ring-green-300'
                                : 'bg-red-500 border-red-700 text-white scale-105 shadow-lg ring-4 ring-red-300')
                            : 'bg-gradient-to-r '.$color.' text-white dark:from-gray-700 dark:to-gray-600 hover:opacity-90'}}">

                            {{-- Efecto visual de selección --}}
                            @if($respuesta === $opcion)
                            <div class="absolute inset-0 bg-white opacity-10 animate-pulse"></div>
                            @endif

                            <div class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fas fa-circle text-sm opacity-80"></i> {{ $opcion }}
                            </div>
                        </button>
                        @endforeach
                    </div>
                    @else
                    <input type="text" wire:model="respuesta" placeholder="✏️ Escribe tu respuesta..."
                        class="w-full border-2 border-blue-400 dark:border-blue-600 rounded-full p-4 text-lg focus:ring focus:ring-green-300 dark:focus:ring-green-500 shadow-md">
                    @endif


                    {{-- ✅ Retroalimentación de respuesta --}}
                    @if($respuesta !== null)
                    @if($respuesta == $items[$itemIndex]['respuesta'])
                    <div class="mt-4 text-green-700 dark:text-green-400 font-bold 
                        flex items-center justify-center gap-2 animate-bounce text-xl">
                        <i class="fas fa-check-circle text-3xl"></i> ¡Correcto!
                    </div>
                    @else
                    <div class="mt-4 text-red-600 dark:text-red-400 font-bold 
                        flex items-center justify-center gap-2 animate-bounce text-xl">
                        <i class="fas fa-times-circle text-3xl"></i> Incorrecto:
                        <span class="underline">{{ $items[$itemIndex]['respuesta'] }}</span>
                    </div>
                    @endif
                    @endif
                </div>


                <!-- Navegación -->
                <div class="flex justify-between mb-4 flex-wrap gap-2">
                    <button wire:click="cerrarModal"
                        class="px-6 py-3 bg-gray-400 dark:bg-gray-600 hover:bg-gray-500 dark:hover:bg-gray-500 text-white rounded-full shadow-md transition flex items-center gap-2 text-lg">
                        <i class="fas fa-times"></i> Salir
                    </button>
                    <button wire:click="siguienteItem"
                        class="px-6 py-3 bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-bold rounded-full shadow-md transition flex items-center gap-2 text-lg">
                        <i class="fas fa-arrow-right"></i> {{ $itemIndex < count($items)-1 ? 'Siguiente' : 'Finalizar'
                            }} </button>
                </div>
                @else
                <!-- Resultados -->
                <div x-init="$nextTick(()=>showConfetti=true)"
                    class="p-6 bg-gradient-to-r from-green-300 via-blue-200 to-green-300 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 rounded-3xl shadow-2xl text-center mb-6">
                    <h4 class="font-extrabold text-3xl md:text-4xl text-green-800 dark:text-green-400 mb-4"><i
                            class="fas fa-trophy text-4xl"></i> ¡Resultados!</h4>
                    <p class="mb-3 text-xl">✅ Correctas: <span class="font-bold text-green-700 dark:text-green-400">{{
                            $respuestasCorrectas }}</span></p>
                    <p class="mb-3 text-xl">❌ Incorrectas: <span class="font-bold text-red-600 dark:text-red-400">{{
                            $respuestasIncorrectas }}</span></p>
                    <p class="mb-5 text-xl">📊 Puntaje: <span class="font-bold text-blue-700 dark:text-blue-400">{{
                            $puntajeFinal }} </span></p>
                </div>

                <!-- Botón cerrar -->
                <div class="flex justify-center mb-4">
                    <button wire:click="cerrarModal"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold rounded-full shadow-md transition flex items-center gap-2 text-lg">
                        <i class="fas fa-check"></i> Listo
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>



    <div class="md:hidden">

        @if($mostrarModal && $actividadSeleccionada)
        <div x-data="{ open: true, showConfetti: false, darkMode: {{ $highContrast ? 'true' : 'false' }} }"
            x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto">

            <!-- Modal -->
            <div class="rounded-2xl block  bg-gray-100 dark:bg-gray-900 shadow-xl w-full max-w-md max-h-[95vh] overflow-y-auto p-4 pb-36 sm:p-6 relative transition-colors duration-300"
                style="font-size: {{ $fontSize }}px;">

                <!-- Accesibilidad -->
                @if($accesibilidad['isn'])
                <div class="mb-3 flex justify-center items-center gap-2 flex-wrap text-sm sm:text-base">
                    <span class="font-semibold flex dark:text-gray-200 items-center gap-1">
                        <i class="fas fa-universal-access"></i> Ajustes:
                    </span>
                    <button wire:click="disminuirFont"
                        class="px-3 py-1 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center gap-1 text-xs sm:text-sm">
                        <i class="fas fa-minus-circle"></i> A-
                    </button>
                    <button wire:click="aumentarFont"
                        class="px-3 py-1 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center gap-1 text-xs sm:text-sm">
                        <i class="fas fa-plus-circle"></i> A+
                    </button>
                    <button @click="darkMode = !darkMode" wire:click="toggleHighContrast"
                        class="px-3 py-1 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center gap-1 text-xs sm:text-sm">
                        <i class="fas fa-adjust"></i> Contraste
                    </button>
                </div>
                @endif

                <!-- Título actividad -->
                <div class="text-center mb-4 sm:mb-5">
                    <h3 class="font-bold text-2xl sm:text-3xl text-blue-600 flex items-center justify-center gap-2">
                        <i class="fas fa-gamepad text-3xl sm:text-4xl"></i> {{ $actividadSeleccionada->titulo }}
                    </h3>
                    <p
                        class="text-sm sm:text-base text-green-700 font-semibold mt-1 flex items-center justify-center gap-1">
                        <i class="fas fa-bullseye"></i> {{ $actividadSeleccionada->objetivo }}
                    </p>
                </div>

                <!-- Multimedia -->
                @if($actividadSeleccionada->media_video || $actividadSeleccionada->media_documento)
                <div class="mb-4 grid grid-cols-1 gap-3">
                    @if($actividadSeleccionada->media_video)
                    @php
                    $videoUrl = $actividadSeleccionada->media_video;
                    $embedType = 'file';
                    if(Str::contains($videoUrl,'youtube.com/watch')) {
                    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                    $videoUrl = isset($query['v']) ? 'https://www.youtube.com/embed/'.$query['v'] : $videoUrl;
                    $embedType='youtube';
                    } elseif(Str::contains($videoUrl,'youtu.be/')) {
                    $videoId = last(explode('/',$videoUrl));
                    $videoUrl = 'https://www.youtube.com/embed/'.$videoId;
                    $embedType='youtube';
                    } elseif(Str::contains($videoUrl,'vimeo.com/')) {
                    $videoId = preg_replace('/[^0-9]/','',$videoUrl);
                    $videoUrl='https://player.vimeo.com/video/'.$videoId;
                    $embedType='vimeo';
                    } elseif(!Str::endsWith($videoUrl,['.mp4','.webm','.ogg'])) {
                    $embedType='link';
                    }
                    @endphp
                    <div class="rounded-xl overflow-hidden shadow-md">
                        @if($embedType==='youtube' || $embedType==='vimeo')
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $videoUrl }}" class="w-full h-48 sm:h-64 rounded-lg shadow" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                        @elseif($embedType==='file')
                        <video controls class="w-full rounded-lg shadow">
                            <source src="{{ $videoUrl }}" type="video/mp4">Tu navegador no soporta video.
                        </video>
                        @else
                        <a href="{{ $videoUrl }}" target="_blank"
                            class="text-blue-600 underline font-semibold text-sm sm:text-base">📺 Ver video</a>
                        @endif
                    </div>
                    @endif

                    @if($actividadSeleccionada->media_documento)
                    @php
                    $docUrl=$actividadSeleccionada->media_documento;
                    $ext=strtolower(pathinfo(parse_url($docUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                    @endphp
                    <div class="rounded-xl overflow-hidden shadow-md">
                        @if($ext==='pdf')
                        <iframe src="{{ $docUrl }}" class="w-full h-48 sm:h-64 rounded-lg shadow"></iframe>
                        @else
                        <a href="{{ $docUrl }}" target="_blank"
                            class="text-blue-600 underline font-semibold flex items-center gap-1 text-sm sm:text-base">
                            📂 Abrir {{ strtoupper($ext) }}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
                @endif

                @if(!$actividadFinalizada)
                <!-- Progreso compacto -->
                <div class="mb-4 flex justify-center flex-wrap gap-1">
                    @foreach(range(1,count($items)) as $i)
                    <div
                        class="w-8 h-8 text-sm sm:text-base rounded-full flex items-center justify-center 
                {{ $i<=$itemIndex ? 'bg-green-500 text-white shadow animate-bounce' : 'bg-gray-300 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $i }}
                    </div>
                    @endforeach
                </div>

                <!-- Pregunta -->
                <div
                    class="p-4 sm:p-5 bg-gradient-to-r from-green-200 via-blue-200 to-green-300 dark:from-gray-800 dark:via-gray-800 dark:to-gray-800 dark:text-gray-200 rounded-2xl shadow-md text-center mb-4">

                    @if($accesibilidad['tts'])
                    <button wire:click="leerEnunciado"
                        class="px-4 py-2 bg-blue-500 text-white rounded-full mb-2 hover:bg-blue-600 transition shadow flex items-center gap-1 text-sm sm:text-base">
                        <i class="fas fa-volume-up"></i> Escuchar
                    </button>
                    @endif

                    <h4
                        class="font-bold text-blue-700 dark:text-blue-400 mb-2 flex items-center justify-center gap-1 text-base sm:text-lg">
                        <i class="fas fa-question-circle"></i> Pregunta {{ $itemIndex+1 }}
                    </h4>

                    <p class="text-gray-800 dark:text-gray-200 mb-3 text-sm sm:text-base">{{
                        $items[$itemIndex]['enunciado'] }}</p>

                    <!-- Botones ayuda IA compactos -->
                    <div class="flex justify-center gap-2 mb-3 flex-wrap">
                        <button wire:click="generarPista"
                            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-full shadow text-xs sm:text-sm flex items-center gap-1">
                            <i class="fas fa-lightbulb"></i> Pista
                        </button>
                        <button wire:click="pedirExplicacion"
                            class="px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded-full shadow text-xs sm:text-sm flex items-center gap-1">
                            <i class="fas fa-book-open"></i> Explicación
                        </button>
                    </div>

                    <!-- IA Feedback -->
                    @if($pistaIA)
                    <div
                        class="mb-2 p-2 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-lg shadow text-sm sm:text-base">
                        <i class="fas fa-info-circle"></i> <strong>Pista:</strong> {{ $pistaIA }}
                    </div>
                    @endif
                    @if($explicacionIA)
                    <div
                        class="mb-2 p-2 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-lg shadow text-sm sm:text-base">
                        <i class="fas fa-book"></i> <strong>Explicación:</strong> {{ $explicacionIA }}
                    </div>
                    @endif

                    @if(isset($items[$itemIndex]['datos']['opciones']))
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        @foreach($items[$itemIndex]['datos']['opciones'] as $opcion)
                        @php
                        $colores = [
                        'from-blue-400 to-blue-600 border-blue-600',
                        'from-green-400 to-green-600 border-green-600',
                        'from-purple-400 to-purple-600 border-purple-600',
                        'from-yellow-400 to-yellow-600 border-yellow-600',
                        'from-pink-400 to-pink-600 border-pink-600',
                        'from-orange-400 to-orange-600 border-orange-600',
                        ];
                        $color = $colores[$loop->index % count($colores)];
                        @endphp

                        <button wire:click="$set('respuesta', '{{ $opcion }}')"
                            class="relative overflow-hidden w-full p-4 text-lg font-semibold rounded-2xl border-4 shadow-md
                       transition-transform duration-300 ease-in-out transform hover:scale-105 focus:outline-none
                       {{ $respuesta === $opcion 
                            ? ($respuesta == $items[$itemIndex]['respuesta'] 
                                ? 'bg-green-500 border-green-700 text-white scale-105 shadow-lg ring-4 ring-green-300'
                                : 'bg-red-500 border-red-700 text-white scale-105 shadow-lg ring-4 ring-red-300')
                            : 'bg-gradient-to-r '.$color.' text-white dark:from-gray-700 dark:to-gray-600 hover:opacity-90'}}">

                            {{-- Efecto visual de selección --}}
                            @if($respuesta === $opcion)
                            <div class="absolute inset-0 bg-white opacity-10 animate-pulse"></div>
                            @endif

                            <div class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fas fa-circle text-sm opacity-80"></i> {{ $opcion }}
                            </div>
                        </button>
                        @endforeach
                    </div>
                    @else
                    <input type="text" wire:model="respuesta" placeholder="✏️ Escribe tu respuesta..."
                        class="w-full border-2 border-blue-400 dark:border-blue-600 rounded-full p-4 text-lg focus:ring focus:ring-green-300 dark:focus:ring-green-500 shadow-md">
                    @endif

                </div>

                <!-- Navegación compacta -->
                <div class="flex justify-between mb-3 flex-wrap gap-2">
                    <button wire:click="cerrarModal"
                        class="flex-1 px-4 py-2 bg-gray-400 dark:bg-gray-600 hover:bg-gray-500 dark:hover:bg-gray-500 text-white rounded-full shadow text-sm sm:text-base flex items-center justify-center gap-1">
                        <i class="fas fa-times"></i> Salir
                    </button>
                    <button wire:click="siguienteItem"
                        class="flex-1 px-4 py-2 bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white font-bold rounded-full shadow text-sm sm:text-base flex items-center justify-center gap-1">
                        <i class="fas fa-arrow-right"></i> {{ $itemIndex < count($items)-1 ? 'Siguiente' : 'Finalizar'
                            }} </button>
                </div>

                @else
                <!-- Resultados -->
                <div x-init="$nextTick(()=>showConfetti=true)"
                    class="p-4 sm:p-5 bg-gradient-to-r from-green-300 via-blue-200 to-green-300 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 rounded-2xl shadow-xl text-center mb-4 text-sm sm:text-base">
                    <h4 class="font-bold text-2xl sm:text-3xl text-green-800 dark:text-green-400 mb-2"><i
                            class="fas fa-trophy"></i> ¡Resultados!</h4>
                    <p class="mb-1">✅ Correctas: <span class="font-bold text-green-700 dark:text-green-400">{{
                            $respuestasCorrectas }}</span></p>
                    <p class="mb-1">❌ Incorrectas: <span class="font-bold text-red-600 dark:text-red-400">{{
                            $respuestasIncorrectas }}</span></p>
                    <p class="mb-2">📊 Puntaje: <span class="font-bold text-blue-700 dark:text-blue-400">{{
                            $puntajeFinal }} / {{ count($items) }}</span></p>
                </div>

                <div class="flex justify-center mb-3">
                    <button wire:click="cerrarModal"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold rounded-full shadow flex items-center gap-1 text-sm sm:text-base">
                        <i class="fas fa-check"></i> Listo
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>






    <style>
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #10b981;
            /* verde */
            top: -10px;
            left: calc(20% * var(--i));
            animation: fall 1.5s linear infinite;
            border-radius: 50%;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(90vh) rotate(360deg);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }
    </style>


</div>

<script>
    document.addEventListener('livewire:init', () => {
    window.addEventListener('tts', event => {
        const utterance = new SpeechSynthesisUtterance(event.detail.text);
        speechSynthesis.speak(utterance);
    });
});
</script>