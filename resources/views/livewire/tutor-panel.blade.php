<div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

    <div class="fixed top-5 right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
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
    
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center gap-2">
        <i class="fas fa-user-shield text-blue-600"></i>Hola {{ auth()->user()->name ?? '---' }} (Tutor)
    </h2>
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-5 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2 mb-4">
            <i class="fas fa-paper-plane text-blue-500"></i> Enviar mensaje al Docente
        </h3>

        <div class="flex flex-col md:flex-row gap-3">
            <input type="text" wire:model.defer="mensaje" placeholder="Escribe un mensaje para el docente..."
                class="flex-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">

            <button wire:click="enviarNotificacionDocente"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Enviar
            </button>
        </div>

        @error('mensaje')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>







    @forelse($hijos as $hijo)
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-5 mb-5">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fas fa-child text-green-500"></i> {{ $hijo->name ?? 'Sin nombre' }}
            <span class="text-sm text-gray-500">({{ $hijo->username ?? '---' }})</span>
        </h3>

        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            {{-- Juegos --}}
            <div class="p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i class="fas fa-gamepad text-yellow-500"></i> Juegos
                </h4>
                @php
                $estadisticaJuegos = $hijo->estadisticaTutor['juegos'] ?? [];
                $totalJuegos = $estadisticaJuegos['total'] ?? 0;
                $completadosJuegos = $estadisticaJuegos['completados'] ?? 0;
                $puntajeTotal = $estadisticaJuegos['puntaje_total'] ?? 0;
                $promedioJuegos = $estadisticaJuegos['promedio'] ?? 0;
                @endphp
                <p>Total: {{ $totalJuegos }}</p>
                <p>Completados: {{ $completadosJuegos }}</p>
                <p>Puntaje total: {{ $puntajeTotal }}</p>
                <p>Promedio: {{ $promedioJuegos }}/100</p>

                <div class="w-full bg-gray-200 rounded-full h-3 mt-2 dark:bg-gray-600">
                    <div class="bg-yellow-500 h-3 rounded-full"
                        style="width: {{ $totalJuegos > 0 ? ($completadosJuegos / $totalJuegos * 100) : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- Actividades --}}
            <div class="p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">
                <h4 class="font-semibold mb-2 flex items-center gap-2">
                    <i class="fas fa-tasks text-purple-500"></i> Actividades
                </h4>
                @php
                $estadisticaAct = $hijo->estadisticaTutor['actividades'] ?? [];
                $totalAct = $estadisticaAct['total'] ?? 0;
                $completadasAct = $estadisticaAct['completadas'] ?? 0;
                $promedioAct = $estadisticaAct['promedio'] ?? 0;
                @endphp
                <p>Total: {{ $totalAct }}</p>
                <p>Completadas: {{ $completadasAct }}</p>
                <p>Promedio: {{ $promedioAct }}/100</p>

                <div class="w-full bg-gray-200 rounded-full h-3 mt-2 dark:bg-gray-600">
                    <div class="bg-purple-500 h-3 rounded-full"
                        style="width: {{ $totalAct > 0 ? ($completadasAct / $totalAct * 100) : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="mt-3 flex gap-2">
                <button wire:click="abrirModal('juegos', {{ $hijo->id ?? 0 }})"
                    class="px-3 py-1 bg-blue-500 text-white rounded text-xs">
                    Ver detalles Juegos
                </button>
                <button wire:click="abrirModal('actividades', {{ $hijo->id ?? 0 }})"
                    class="px-3 py-1 bg-purple-500 text-white rounded text-xs">
                    Ver detalles Actividades
                </button>
            </div>

        </div>
    </div>
    @empty
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i> No tienes hijos registrados en el sistema.
    </div>
    @endforelse

    {{-- Notificaciones --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-5 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2 mb-4">
            <i class="fas fa-bell text-red-500"></i> Notificaciones
        </h3>

        <ul class="space-y-3">
            @forelse($notificaciones as $notificacion)
            <li
                class="flex justify-between items-start gap-3 p-3 
                       rounded-lg border 
                       {{ $notificacion->read_at ? 'bg-gray-50 dark:bg-gray-700' : 'bg-blue-50 dark:bg-blue-900 border-blue-400' }}">
                <div class="flex items-start gap-3">
                    <i class="fas fa-envelope {{ $notificacion->data['color'] ?? 'text-blue-500' }} mt-1"></i>
                    <div>
                        <p class="text-sm font-medium">{{ $notificacion->data['titulo'] ?? '' }}</p>
                        <p class="text-xs text-gray-500">{{ $notificacion->data['mensaje'] ?? '' }}</p>
                        <p class="text-[10px] text-gray-400">{{ $notificacion->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                @if(!$notificacion->read_at)
                <button wire:click="marcarLeida('{{ $notificacion->id }}')"
                    class="text-xs text-blue-600 hover:underline">
                    Marcar leída
                </button>
                @endif
            </li>
            @empty
            <li class="text-gray-500 text-sm">No hay notificaciones.</li>
            @endforelse
        </ul>
    </div>


    {{-- Modal --}}
    @if($modalAbierto && $modalHijo)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-11/12 md:w-2/3 max-h-[80vh] overflow-y-auto p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    {{ $modalTipo == 'juegos' ? 'Detalle de Juegos' : 'Detalle de Actividades' }} -
                    {{ $modalHijo->name ?? '---' }}
                </h3>
                <button wire:click="cerrarModal" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="p-2">Nombre</th>
                        @if($modalTipo == 'juegos')
                        <th class="p-2">Puntaje</th>
                        <th class="p-2">Total Preguntas</th>
                        <th class="p-2">Promedio (%)</th>
                        @endif
                        <th class="p-2">Completado</th>
                        <th class="p-2">Última actividad</th>
                    </tr>
                </thead>
                <tbody>
                    @if($modalTipo == 'juegos')
                    @foreach(collect($modalHijo->juegos) as $juego)
                    <tr class="border-t">
                        <td class="p-2">{{ $juego->nombre ?? '---' }}</td>
                        <td class="p-2">{{ $juego->pivot->puntaje ?? 0 }}</td>
                        <td class="p-2">{{ $juego->preguntas->count() ?? 0 }}</td>
                        <td class="p-2">
                            {{ $juego->preguntas->count()
                            ? round(($juego->pivot->puntaje ?? 0) / ($juego->preguntas->count()*2)*100,1)
                            : 0 }}
                        </td>
                        <td class="p-2">{{ ($juego->pivot->completado ?? false) ? 'Sí' : 'No' }}</td>
                        <td class="p-2">{{ $juego->pivot->ultima_partida ?? '' }}</td>
                    </tr>
                    @endforeach
                    @else
                    @foreach(collect($modalHijo->intentos) as $intento)
                    <tr class="border-t">
                        <td class="p-2">{{ $intento->actividad->nombre ?? '---' }}</td>
                        <td class="p-2">{{ ($intento->puntaje ?? 0) > 0 ? 'Sí' : 'No' }}</td>
                        <td class="p-2">{{ $intento->fin ?? '' }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>