<div
    class="{{ $modoAccesible ? 'text-lg leading-8' : '' }} p-6
     bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 md:gap-0">
        <h2
            class="text-2xl md:text-3xl font-extrabold text-center md:text-left text-gray-800 dark:text-gray-100 drop-shadow">
            🎓 Bienvenido {{ auth()->user()->name }}
            <span class="block text-base md:text-lg font-medium text-gray-600 dark:text-gray-400">
                Tu grado es: {{ $grado->nombre ?? 'Sin grado asignado' }}
            </span>
        </h2>

        <div
            class="flex flex-col sm:flex-row items-center sm:items-end md:items-center gap-3 md:gap-4 w-full md:w-auto justify-center md:justify-end">
            {{-- XP y progreso rápido --}}
            <div class="text-center sm:text-right w-full sm:w-auto">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    XP: <strong>{{ $xp }}</strong>
                </div>
                <div class="w-full sm:w-48 bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden mt-1">
                    <div class="h-3 rounded-full transition-all duration-500"
                        style="width: {{ $porcentajeProgreso }}%; background: linear-gradient(90deg,#34d399,#3b82f6)">
                    </div>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ $porcentajeProgreso }}% completado
                </div>
            </div>

            {{-- Botón modo accesible --}}
            <button wire:click="toggleAccesibilidad"
                class="bg-blue-600 text-white rounded-full p-3 shadow hover:bg-blue-700 focus:outline-none transition-transform active:scale-95"
                title="Activar modo accesible">
                <i class="fas fa-universal-access"></i>
            </button>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Actividades --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-tasks text-blue-500"></i> Actividades
            </h3>

            {{-- PENDIENTES --}}
            <div class="mb-6">
                <h4 class="text-lg font-semibold mb-2 text-gray-600 dark:text-gray-400">Pendientes</h4>
                @if($actividadesPendientes->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-400"></i> No tienes actividades pendientes 🎉
                </p>
                @else
                <ul class="space-y-2">
                    @foreach($actividadesPendientes as $act)
                    <li class="flex items-center gap-2 bg-blue-50 dark:bg-gray-700 rounded-lg p-2 shadow-sm">
                        <i class="fas fa-hourglass-half text-yellow-500"></i>
                        <div class="flex-1">
                            <strong class="text-gray-800 dark:text-gray-200">{{ $act->titulo }}</strong>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $act->indicador->titulo ?? '' }}</p>
                        </div>

                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            {{-- COMPLETADAS --}}
            <div>
                <h4 class="text-lg font-semibold mb-2 text-gray-600 dark:text-gray-400">Completadas</h4>
                @if($actividadesCompletadas->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                    <i class="fas fa-info-circle text-gray-400"></i> No has completado ninguna actividad aún.
                </p>
                @else
                <ul class="space-y-2">
                    @foreach($actividadesCompletadas as $act)
                    <li class="flex items-center gap-2 bg-green-50 dark:bg-gray-700 rounded-lg p-2 shadow-sm">
                        <i class="fas fa-check text-green-600"></i>
                        <div>
                            <strong class="text-gray-800 dark:text-gray-200">{{ $act->titulo }}</strong>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $act->indicador->titulo ?? '' }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>


        </div>

        {{-- Trofeos & Bonificaciones (dinámico) --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-trophy text-yellow-400"></i> Trofeos & Bonificaciones
            </h3>

            <div class="flex flex-col gap-3">
                @foreach($recompensas as $r)
                <div class="flex items-center justify-between gap-3 bg-yellow-50 dark:bg-gray-700 rounded-lg p-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-white dark:bg-gray-800 flex items-center justify-center shadow">
                            @if($r->icono_url && Str::startsWith($r->icono_url, ['http', 'storage/', '/images/']))
                            {{-- Es una URL de imagen --}}
                            <img src="{{ asset($r->icono_url) }}" alt="{{ $r->tipo }}" class="w-8 h-8">
                            @elseif($r->icono_url)
                            {{-- Es una clase de ícono Font Awesome --}}
                            <i class="{{ $r->icono_url }}"></i>
                            @else
                            {{-- Fallback --}}
                            <i class="fas fa-star text-yellow-500"></i>
                            @endif
                        </div>

                        <div>
                            <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $r->tipo }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $r->descripcion }}</div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $r->puntos_requeridos }} XP</div>

                        @if(auth()->user()->recompensas()->where('recompensa_id', $r->id)->exists())
                        <div class="text-sm text-green-600">Obtenida ✓</div>
                        @else
                        <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm"></button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Gana más trofeos completando actividades y desafíos.
            </p>
        </div>

        {{-- Retos activos --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-fire text-red-500"></i> Retos Activos
            </h3>

            @if(count($retos) > 0)
            <ul class="space-y-3">
                @foreach($retos as $reto)
                <li class="flex items-center justify-between {{ $reto['fondo'] }} rounded-lg p-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas {{ $reto['icono'] }}"></i>
                        <span class="text-gray-800 dark:text-gray-200">{{ $reto['titulo'] }}</span>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $reto['progreso'] }}/{{ $reto['meta'] }}
                    </span>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500 dark:text-gray-400">No hay retos activos.</p>
            @endif
        </div>

    </div>

    {{-- Eventos JS para accesibilidad (SpeechSynthesis, cambios UI) --}}
    <script>
        window.addEventListener('accesibilidad-cambiada', (e) => {
            if (e.detail.modo) {
                // TTS de bienvenida en modo accesible
                if ('speechSynthesis' in window) {
                    const msg = new SpeechSynthesisUtterance('Modo accesible activado. Interfaz optimizada para contraste y lectura.');
                    window.speechSynthesis.speak(msg);
                }
            } else {
                if ('speechSynthesis' in window) {
                    const msg = new SpeechSynthesisUtterance('Modo accesible desactivado.');
                    window.speechSynthesis.speak(msg);
                }
            }
        });

        // Notificaciones de recompensa
        window.addEventListener('recompensa-obtenida', e => {
            const data = e.detail;
            alert(`¡Has obtenido una recompensa! ${data.nombre}`);
        });

        // Toastr-like simple event
        window.addEventListener('toast', e => {
            const {
                type
                , message
            } = e.detail;
            alert(message);
        });

    </script>
</div>