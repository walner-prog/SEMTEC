<div>
    <h2 class="text-2xl font-bold mb-4">Revisión de Tareas</h2>


    {{-- Filtros Escritorio --}}
    {{-- Filtros Escritorio --}}
    <div class="hidden md:grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select wire:model.live="estado"
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                <option value="pendientes">Pendientes de revisión</option>
                <option value="revisados">Revisados</option>
                <option value="todos">Todos</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grado</label>
            <select wire:model.live="grado_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                <option value="">Todos</option>
                @foreach($grados as $grado)
                <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unidad</label>
            <select wire:model.live="unidad_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                {{ !$grado_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($unidades as $unidad)
                <option value="{{ $unidad->id }}">{{ $unidad->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Competencia</label>
            <select wire:model.live="competencia_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                {{ !$unidad_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($competencias as $competencia)
                <option value="{{ $competencia->id }}">{{ $competencia->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Actividad</label>
            <select wire:model.live="actividad_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                {{ !$competencia_id ? 'disabled' : '' }}>
                <option value="">Todas</option>
                @foreach($actividades as $actividad)
                <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Filtros Móvil --}}
    <div class="md:hidden mb-4" x-data="{ open: false }">
        <button @click="open = !open"
            class="w-full flex justify-between items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-md shadow-sm text-gray-700 dark:text-gray-300 font-medium">
            <span>Filtros</span>
            <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition class="mt-2 space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                <select wire:model.live="estado"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                    <option value="pendientes">Pendientes de revisión</option>
                    <option value="revisados">Revisados</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grado</label>
                <select wire:model.live="grado_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                    <option value="">Todos</option>
                    @foreach($grados as $grado)
                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unidad</label>
                <select wire:model.live="unidad_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                    {{ !$grado_id ? 'disabled' : '' }}>
                    <option value="">Todas</option>
                    @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Competencia</label>
                <select wire:model.live="competencia_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                    {{ !$unidad_id ? 'disabled' : '' }}>
                    <option value="">Todas</option>
                    @foreach($competencias as $competencia)
                    <option value="{{ $competencia->id }}">{{ $competencia->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Actividad</label>
                <select wire:model.live="actividad_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200"
                    {{ !$competencia_id ? 'disabled' : '' }}>
                    <option value="">Todas</option>
                    @foreach($actividades as $actividad)
                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>



    <!-- Mensajes de éxito -->
    @if(session('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('message') }}
    </div>
    @endif

    <!-- Tabla de intentos -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">

        {{-- Versión escritorio --}}
        <div class="hidden md:block">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Estudiante</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actividad</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Fecha</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Estado</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($intentos as $intento)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{
                            $intento->usuario->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{
                            $intento->actividad->titulo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{
                            $intento->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($intento->revision && $intento->revision->revisado)
                            <span
                                class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full">Revisado</span>
                            @else
                            <span
                                class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs rounded-full">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="abrirModalRevision({{ $intento->id }})"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-2 text-sm">Revisar</button>
                            @if(!$intento->revision || !$intento->revision->revisado)
                            <button wire:click="marcarComoRevisado({{ $intento->id }})"
                                class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200 text-sm">Marcar
                                como revisado</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">No hay tareas
                            para revisar con los filtros seleccionados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Versión móvil --}}
        <div class="md:hidden space-y-4 p-4">
            @forelse($intentos as $intento)
            <div class="border rounded-lg p-4 shadow-sm bg-gray-50 dark:bg-gray-700">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Estudiante:</span>
                    <span class="text-gray-800 dark:text-gray-200">{{ $intento->usuario->name }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Actividad:</span>
                    <span class="text-gray-800 dark:text-gray-200">{{ $intento->actividad->titulo }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Fecha:</span>
                    <span class="text-gray-800 dark:text-gray-200">{{ $intento->created_at->format('d/m/Y H:i')
                        }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Estado:</span>
                    @if($intento->revision && $intento->revision->revisado)
                    <span
                        class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded-full">Revisado</span>
                    @else
                    <span
                        class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs rounded-full">Pendiente</span>
                    @endif
                </div>
                <div class="flex gap-2 mt-2">
                    <button wire:click="abrirModalRevision({{ $intento->id }})"
                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 text-sm">Revisar</button>
                    @if(!$intento->revision || !$intento->revision->revisado)
                    <button wire:click="marcarComoRevisado({{ $intento->id }})"
                        class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200 text-sm">Marcar
                        como revisado</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 dark:text-gray-300">
                No hay tareas para revisar con los filtros seleccionados.
            </div>
            @endforelse
        </div>

    </div>



    <!-- Paginación -->
    <div class="mt-4">
        {{ $intentos->links() }}
    </div>

    <!-- Modal de Retroalimentación -->
  @if($mostrarModal)
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 dark:bg-gray-900 dark:bg-opacity-60 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                Revisión de: {{ $intentoSeleccionado->usuario->name }} - {{ $intentoSeleccionado->actividad->titulo }}
            </h3>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Retroalimentación</label>
                <textarea wire:model="retroalimentacion"
                          class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" 
                          rows="4"
                          placeholder="Escribe tus comentarios y sugerencias..."></textarea>
                @error('retroalimentacion') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Calificación (0-100)</label>
                <input type="number" wire:model="calificacion"
                       class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200"
                       min="0" max="100" placeholder="Opcional">
                @error('calificacion') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button wire:click="cerrarModal"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                    Cancelar
                </button>
                <button wire:click="guardarRevision"
                        class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                    Guardar Revisión
                </button>
            </div>
        </div>
    </div>
</div>
@endif

</div>