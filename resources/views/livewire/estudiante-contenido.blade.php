<div>
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">
        ✨ Actividades disponibles ✨
    </h2>

    <!-- Notificaciones -->
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

    <!-- Lista de actividades -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
            dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

        {{-- 🔹 Sección Actividades (col 10) --}}
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


        {{-- 🔹 Columna lateral (col 3) --}}
        <div class="lg:col-span-3 flex flex-col gap-6">

            <h2 class="text-2xl font-bold  text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fas fa-tasks text-blue-500"></i> Mas Secciones
            </h2>

            {{-- 📚 Aprende con IA --}}
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    <i class="fas fa-robot text-purple-500"></i> Aprende con IA
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Descubre cómo la inteligencia artificial puede personalizar tus estudios y ayudarte a mejorar en
                    cada reto 🚀.
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
                <button
                    class="mt-4 w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow flex items-center justify-center gap-2">
                    <i class="fas fa-brain"></i> Probar IA
                </button>
            </div>

            {{-- 📰 Noticias & Tips --}}
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
                        Cuida tu progreso: estudia un poco cada día 💡
                    </li>
                </ul>
            </div>
        </div>


        {{-- 🌟 Progreso General (col 12 que aparece en medio) --}}
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




    <!-- Modal Mejorado para Actividad -->
    @if($mostrarModal && $actividadSeleccionada)
    <div x-data="{ open: true, showConfetti: false }" x-show="open"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl shadow-2xl w-11/12 md:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative"
            style="font-size: {{ $fontSize }}px; {{ $highContrast ? 'background-color:#000;color:#fff;' : '' }}">

            <!-- Ajuste tipografía -->
            @if($accesibilidad['isn'])
            <div class="mb-4 flex justify-center items-center gap-2 flex-wrap">
                <span class="font-semibold">✏️ Ajustar tamaño de texto:</span>
                <button wire:click="disminuirFont"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 transition">A-</button>
                <button wire:click="aumentarFont"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 transition">A+</button>
                <button wire:click="toggleHighContrast"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 transition">⚡ Contraste</button>
            </div>
            @endif


            <div class="text-center mb-4">
                <h3 class="font-extrabold text-3xl text-blue-600 animate-bounce">Actividad: {{
                    $actividadSeleccionada->titulo }}
                </h3>
                <p class="text-lg text-green-700 font-semibold mt-2 animate-fadeIn">Objetivo: {{
                    $actividadSeleccionada->objetivo
                    }}</p>
            </div>

            <!-- Media animada -->
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
                        <iframe src="{{ $videoUrl }}" class="w-full h-64 rounded-lg shadow-lg" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                    @elseif($embedType==='file')
                    <video controls class="w-full rounded-lg shadow-lg">
                        <source src="{{ $videoUrl }}" type="video/mp4">Tu navegador no soporta video.
                    </video>
                    @else
                    <a href="{{ $videoUrl }}" target="_blank" class="text-blue-600 underline font-bold">📺 Ver video</a>
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

            <div class="mb-6 flex justify-center gap-2">
                @foreach(range(1,count($items)) as $i)
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center 
                        {{ $i<=$itemIndex ? 'bg-green-400 text-white shadow-lg animate-bounce' : 'bg-gray-300 text-gray-500' }} transition-all">
                    {{ $i }}
                </div>
                @endforeach
            </div>


            <div
                class="p-5 bg-gradient-to-r from-green-200 via-blue-200 to-green-300 rounded-3xl shadow-xl text-center mb-6 transform hover:scale-100 transition-all duration-300 animate-fadeIn">
                @if($accesibilidad['tts'])
                <button wire:click="leerEnunciado"
                    class="px-4 py-2 bg-blue-500 text-white rounded-full mb-3 hover:bg-blue-600 transition shadow-md">
                    🔊 Escuchar enunciado
                </button>
                @endif

                <h4 class="font-bold text-blue-700 mb-3 flex items-center justify-center gap-2 text-xl">
                    <i class="fas fa-question-circle"></i> Pregunta {{ $itemIndex+1 }}
                </h4>

                <p class="text-gray-800 mb-4 text-lg">{{ $items[$itemIndex]['enunciado'] }}</p>

                <!-- Botones de ayuda IA -->
                <div class="flex justify-center gap-4 mb-4 animate-fadeIn">
                    <button
                        class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-full shadow-md transition flex items-center gap-2"
                        title="Pide ayuda con IA">
                        🤖 Pista IA
                    </button>
                    <button
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded-full shadow-md transition flex items-center gap-2"
                        title="Explicación de la pregunta">
                        📘 Explicación IA
                    </button>
                </div>

                <input type="text" wire:model="respuesta" placeholder="✏️ Escribe tu respuesta..."
                    class="w-full border-2 border-blue-400 rounded-full p-3 focus:ring focus:ring-green-300 shadow-md">


                @if($respuesta!==null)
                @if($respuesta==$items[$itemIndex]['respuesta'])
                <div
                    class="mt-3 text-green-700 font-bold flex items-center justify-center gap-2 animate-bounce text-lg">
                    <i class="fas fa-check-circle text-2xl"></i> ¡Correcto!
                </div>
                @else
                <div class="mt-3 text-red-600 font-bold flex items-center justify-center gap-2 animate-bounce text-lg">
                    <i class="fas fa-times-circle text-2xl"></i> Incorrecto: <span class="underline">{{
                        $items[$itemIndex]['respuesta'] }}</span>
                </div>
                @endif
                @endif
            </div>

            <!-- Botones -->
            <div class="flex justify-between mb-4">
                <button wire:click="cerrarModal"
                    class="px-5 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-full shadow-md transition">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button wire:click="siguienteItem"
                    class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full shadow-md transition">
                    {{ $itemIndex < count($items)-1 ? '➡️ Siguiente' : '🏁 Finalizar' }} </button>
            </div>
            @else
            <!-- Resultados finales con confeti -->
            <div x-init="$nextTick(()=>showConfetti=true)"
                class="p-6 bg-gradient-to-r from-green-300 via-blue-200 to-green-300 rounded-3xl shadow-2xl text-center mb-6 animate-fadeIn">
                <h4 class="font-extrabold text-3xl text-green-800 mb-4">🏆 ¡Resultados!</h4>
                <p class="mb-2 text-lg">Correctas: <span class="font-bold text-green-700">{{ $respuestasCorrectas
                        }}</span></p>
                <p class="mb-2 text-lg">Incorrectas: <span class="font-bold text-red-600">{{ $respuestasIncorrectas
                        }}</span></p>
                <p class="mb-4 text-lg">Puntaje: <span class="font-bold text-blue-700">{{ $puntajeFinal }} / {{
                        count($items) }}</span></p>

                @if($respuestasCorrectas==count($items))
                <div class="text-green-700 font-extrabold text-xl animate-bounce">🌟 ¡Excelente trabajo! Todo correcto.
                </div>
                @elseif($respuestasCorrectas>=(count($items)/2))
                <div class="text-yellow-600 font-bold text-xl animate-bounce">💡 ¡Muy bien! Solo un poco más de
                    práctica.</div>
                @else
                <div class="text-red-600 font-bold text-xl animate-bounce">📚 Sigue practicando, ¡lo lograrás!</div>
                @endif
            </div>

            <!-- Confeti -->
            <template x-if="showConfetti">
                <div class="absolute inset-0 pointer-events-none">
                    <div class="confetti animate-fall" style="--i:0;"></div>
                    <div class="confetti animate-fall" style="--i:1;"></div>
                    <div class="confetti animate-fall" style="--i:2;"></div>
                    <div class="confetti animate-fall" style="--i:3;"></div>
                    <div class="confetti animate-fall" style="--i:4;"></div>
                </div>
            </template>

            <!-- Botón cerrar -->
            <div class="flex justify-center mb-4">
                <button wire:click="cerrarModal"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full shadow-md transition">
                    <i class="fas fa-check"></i> Listo
                </button>
            </div>
            @endif

        </div>
    </div>
    @endif

    <!-- CSS Confeti (Tailwind + custom) -->
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