<div x-data="{ mostrarModal: false }" class="space-y-6 dark:bg-gray-900 dark:text-gray-200 p-4">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold">Reportes de Desempeño por Estudiante</h2>
        <button @click="mostrarModal = true"
                class="ml-4 text-sm px-3 py-1 bg-indigo-100 text-indigo-700 rounded hover:bg-indigo-200 dark:bg-indigo-700 dark:text-indigo-100 dark:hover:bg-indigo-600 transition">
            ℹ️ Explicación
        </button>
    </div>

    <!-- Filtros -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium">Grado *</label>
            <select wire:model.live="grado_id"
                    class="mt-1 block w-full border rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                <option value="">Seleccionar grado</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Unidad</label>
            <select wire:model.live="unidad_id"
                    class="mt-1 block w-full border rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                    {{ !$grado_id ? 'disabled' : '' }}>
                <option value="">Todas las unidades</option>
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->titulo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Estudiante *</label>
            <select wire:model.live="estudiante_id"
                    class="mt-1 block w-full border rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                    {{ !$grado_id ? 'disabled' : '' }}>
                <option value="">Seleccionar estudiante</option>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}">{{ $estudiante->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="block text-sm font-medium">Fecha inicio</label>
                <input type="date" wire:model.live="fecha_inicio"
                       class="mt-1 block w-full border rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium">Fecha fin</label>
                <input type="date" wire:model.live="fecha_fin"
                       class="mt-1 block w-full border rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex flex-wrap gap-2 mb-6">
        <button wire:click="generarReporte"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
            Generar Reporte
        </button>

        @if(!empty($reporteData))
            <button wire:click="descargarPDF"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition">
                Descargar PDF
            </button>

            <button wire:click="descargarExcel"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 transition">
                Descargar Excel
            </button>
        @endif
    </div>

    <!-- Mensajes -->
    @if(session('message'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">
            {{ session('message') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Reporte -->
 @if(!empty($reporteData))
<div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
            Reporte de Desempeño: {{ $reporteData['estudiante']->name }}
        </h3>

        <!-- Estadísticas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @php
                $estadisticas = [
                    ['valor'=>$reporteData['estadisticas']['total_actividades'],'label'=>'Total Actividades','color'=>'blue'],
                    ['valor'=>$reporteData['estadisticas']['actividades_completadas'],'label'=>'Completadas','color'=>'green'],
                    ['valor'=>$reporteData['estadisticas']['promedio_puntaje'],'label'=>'Puntaje Promedio','color'=>'yellow'],
                    ['valor'=>$reporteData['estadisticas']['actividades_revisadas'],'label'=>'Revisadas','color'=>'purple'],
                ];
            @endphp
           @foreach($estadisticas as $est)
<div class="p-4 rounded-lg text-center relative group 
    bg-{{ $est['color'] }}-50 dark:bg-gray-700/30">
    <div class="text-2xl font-bold text-{{ $est['color'] }}-600 dark:text-white">
        {{ $est['valor'] }}
    </div>
    <div class="text-sm font-medium text-{{ $est['color'] }}-800 dark:text-gray-200">
        {{ $est['label'] }}
    </div>
</div>
@endforeach

        </div>

        <!-- Detalles de actividades -->
        <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-3">Detalle de Actividades</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Actividad</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Fecha</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Aciertos</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Puntaje</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($reporteData['intentos'] as $intento)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $intento->actividad->titulo }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $intento->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $intento->aciertos }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $intento->puntaje }}</td>
                        <td class="px-4 py-2">
                            @if($intento->revision && $intento->revision->revisado)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full dark:bg-green-700 dark:text-green-100">Revisado</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full dark:bg-yellow-700 dark:text-yellow-100">Pendiente</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


    <!-- Modal Explicativo -->
    <div x-show="mostrarModal" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4" 
         x-transition>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button @click="mostrarModal = false" 
                    class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">✖</button>
            <h3 class="text-xl font-bold mb-4">Explicación del Reporte</h3>
            <ul class="list-disc pl-6 space-y-2 text-gray-700 dark:text-gray-200">
                <li><b>Total Actividades:</b> Número total de actividades asignadas al estudiante en el período seleccionado.</li>
                <li><b>Completadas:</b> Actividades que el estudiante terminó y entregó.</li>
                <li><b>Puntaje Promedio:</b> Promedio de las calificaciones obtenidas en las actividades.</li>
                <li><b>Revisadas:</b> Actividades que ya fueron revisadas y evaluadas por el docente.</li>
                <li><b>Detalle de Actividades:</b> Muestra fecha, puntaje, aciertos y estado de cada intento.</li>
            </ul>
        </div>
    </div>

</div>
