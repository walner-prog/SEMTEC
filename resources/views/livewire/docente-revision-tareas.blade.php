<div>
    <h2 class="text-2xl font-bold mb-4">Revisión de Tareas</h2>

    <!-- Filtros -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select wire:model.live="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="pendientes">Pendientes de revisión</option>
                <option value="revisados">Revisados</option>
                <option value="todos">Todos</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Grado</label>
            <select wire:model.live="grado_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Todos</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Unidad</label>
            <select wire:model.live="unidad_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                    {{ !$grado_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Competencia</label>
            <select wire:model.live="competencia_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    {{ !$unidad_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($competencias as $competencia)
                    <option value="{{ $competencia->id }}">{{ $competencia->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Actividad</label>
            <select wire:model.live="actividad_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    {{ !$competencia_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($actividades as $actividad)
                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Mensajes de éxito -->
    @if(session('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('message') }}
    </div>
    @endif

    <!-- Tabla de intentos -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($intentos as $intento)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $intento->usuario->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $intento->actividad->titulo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $intento->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($intento->revision && $intento->revision->revisado)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Revisado</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="abrirModalRevision({{ $intento->id }})" 
                                    class="text-blue-600 hover:text-blue-900 mr-2">
                                Revisar
                            </button>
                            @if(!$intento->revision || !$intento->revision->revisado)
                                <button wire:click="marcarComoRevisado({{ $intento->id }})" 
                                        class="text-green-600 hover:text-green-900">
                                    Marcar como revisado
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            No hay tareas para revisar con los filtros seleccionados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $intentos->links() }}
    </div>

    <!-- Modal de Retroalimentación -->
    @if($mostrarModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Revisión de: {{ $intentoSeleccionado->usuario->name }} - {{ $intentoSeleccionado->actividad->titulo }}
                    </h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Retroalimentación</label>
                        <textarea wire:model="retroalimentacion" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                rows="4"
                                placeholder="Escribe tus comentarios y sugerencias..."></textarea>
                        @error('retroalimentacion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Calificación (0-100)</label>
                        <input type="number" wire:model="calificacion" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                               min="0" max="100"
                               placeholder="Opcional">
                        @error('calificacion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button wire:click="cerrarModal" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Cancelar
                        </button>
                        <button wire:click="guardarRevision" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Guardar Revisión
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>