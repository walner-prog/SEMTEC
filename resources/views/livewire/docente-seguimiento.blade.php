<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Seguimiento de Actividades
        </h2>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Monitoree el rendimiento de los estudiantes en tiempo real
        </div>
    </div>

    <!-- Contenedor de filtros -->
    <div x-data="{ open: false }" class="mb-4">
        <!-- Botón para móvil -->
        <div
            class="md:hidden flex justify-between items-center p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
            <span class="font-semibold text-gray-700 dark:text-gray-300">Filtros</span>
            <button @click="open = !open" class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm">
                <span x-show="!open">Abrir</span>
                <span x-show="open">Cerrar</span>
            </button>
        </div>

        <!-- Filtros -->
        <div x-show="open || window.innerWidth >= 768" @click.away="open = false"
            class="grid mb-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-300">
            <!-- Grado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grado</label>
                <select wire:model.live="grado_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                    {{ $grados->isEmpty() ? 'disabled' : '' }}>
                    @if($grados->isEmpty())
                    <option value="">(No tiene grados asignados)</option>
                    @else
                    <option value="">Todos los grados</option>
                    @foreach($grados as $grado)
                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <!-- Unidad -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unidad</label>
                <select wire:model.live="unidad_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                    {{ !$grado_id ? 'disabled' : '' }}>
                    <option value="">Todas las unidades</option>
                    @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Competencia -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Competencia</label>
                <select wire:model.live="competencia_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                    {{ !$unidad_id ? 'disabled' : '' }}>
                    <option value="">Todas</option>
                    @foreach($competencias as $competencia)
                    <option value="{{ $competencia->id }}">{{ $competencia->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Indicador -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Indicador</label>
                <select wire:model.live="indicador_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                    {{ !$competencia_id ? 'disabled' : '' }}>
                    <option value="">Todos</option>
                    @foreach($indicadores as $indicador)
                    <option value="{{ $indicador->id }}">{{ $indicador->codigo }} - {{ $indicador->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Actividad -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Actividad</label>
                <select wire:model.live="actividad_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500"
                    {{ !$indicador_id ? 'disabled' : '' }}>
                    <option value="">Todas</option>
                    @foreach($actividades as $actividad)
                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>




    <!-- Filtros aplicados -->
    @if($grado_id || $unidad_id || $competencia_id || $indicador_id || $actividad_id)
    <div class="flex items-center gap-2 p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-sm">
        <i class="fas fa-filter text-blue-600 dark:text-blue-300"></i>
        <p class="text-blue-800 dark:text-blue-200">
            <span class="font-medium">Filtros aplicados:</span>
            @if($grado_id) Grado: {{ $grados->firstWhere('id', $grado_id)?->nombre }} @endif
            @if($unidad_id) | Unidad: {{ $unidades->firstWhere('id', $unidad_id)?->titulo }} @endif
            @if($competencia_id) | Competencia: {{ $competencias->firstWhere('id', $competencia_id)?->titulo }} @endif
            @if($indicador_id) | Indicador: {{ $indicadores->firstWhere('id', $indicador_id)?->codigo }} @endif
            @if($actividad_id) | Actividad: {{ $actividades->firstWhere('id', $actividad_id)?->titulo }} @endif
        </p>
    </div>
    @endif

    <!-- Resultados -->
    <div>
        <!-- Tabla para escritorio -->
        <div
            class="hidden md:block bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Estudiante</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Actividad</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Fecha</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Aciertos</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Errores</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Tiempo (seg)</th>
                        <th
                            class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Puntaje</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($intentos as $intento)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{
                            $intento->usuario->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{
                            $intento->actividad->titulo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{
                            $intento->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium">{{ $intento->aciertos }}
                        </td>
                        <td class="px-6 py-4 text-red-600 dark:text-red-400 font-medium">{{ $intento->errores }}</td>
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $intento->tiempo_seg }}</td>
                        <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">{{ $intento->puntaje }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2"></i>
                            <p>
                                @if($grado_id || $unidad_id || $competencia_id || $indicador_id || $actividad_id)
                                No se encontraron resultados con los filtros aplicados.
                                @else
                                No hay intentos registrados todavía.
                                @endif
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cards para móvil -->
        <div class="md:hidden space-y-3">
            @forelse($intentos as $intento)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-gray-100 dark:border-gray-700">
                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $intento->usuario->name }}</p>
                <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $intento->actividad->titulo }}</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $intento->created_at->format('d/m/Y H:i') }}</p>
                <div class="flex justify-between mt-2 text-sm">
                    <span class="text-green-600 dark:text-green-400 font-medium">Aciertos: {{ $intento->aciertos
                        }}</span>
                    <span class="text-red-600 dark:text-red-400 font-medium">Errores: {{ $intento->errores }}</span>
                </div>
                <div class="flex justify-between mt-1 text-sm text-gray-800 dark:text-gray-200">
                    <span>Tiempo: {{ $intento->tiempo_seg }} seg</span>
                    <span class="font-semibold text-blue-600 dark:text-blue-400">Puntaje: {{ $intento->puntaje }}</span>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 dark:text-gray-400 p-4">
                <i class="fas fa-inbox text-3xl mb-2"></i>
                <p>
                    @if($grado_id || $unidad_id || $competencia_id || $indicador_id || $actividad_id)
                    No se encontraron resultados con los filtros aplicados.
                    @else
                    No hay intentos registrados todavía.
                    @endif
                </p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Paginación -->
    <div class="pt-4">
        {{ $intentos->links() }}
    </div>

</div>