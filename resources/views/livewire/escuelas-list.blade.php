<div class="p-4">

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

    <!-- Encabezado y búsqueda -->
   <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">Escuelas</h2>
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <input type="text" wire:model.live="search" placeholder="Buscar escuela..."
            class="border rounded px-2 py-1 w-full sm:w-auto
                   border-gray-300 dark:border-gray-600
                   bg-white dark:bg-gray-800
                   text-gray-900 dark:text-gray-100
                   placeholder-gray-400 dark:placeholder-gray-500" />
        <button wire:click="abrirModalCrear"
            class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 
                   w-full sm:w-auto transition">Crear Escuela</button>
    </div>
</div>

<!-- Tabla de escuelas -->
<div class="overflow-x-auto">
    <table class="min-w-full border rounded 
                   bg-white dark:bg-gray-800 
                   border-gray-300 dark:border-gray-700">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200">Nombre</th>
                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200">Dirección</th>
                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200">Director</th>
                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($escuelas as $escuela)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $escuela->nombre }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $escuela->direccion }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $escuela->director }}</td>
                    <td class="px-4 py-2">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button wire:click="abrirModalEditar({{ $escuela->id }})"
                                class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 w-full sm:w-auto transition">Editar</button>
                            <button wire:click="confirmarEliminar({{ $escuela->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 w-full sm:w-auto transition">Eliminar</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                        No se encontraron escuelas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <div class="mt-4">
        {{ $escuelas->links() }}
    </div>

    <!-- Modal Crear / Editar Escuela -->
   @if ($isOpen)
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div
        class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-2xl max-h-[90vh] p-6 overflow-y-auto border border-gray-300 dark:border-gray-700 shadow-lg">
        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">
            {{ $modo === 'crear' ? 'Crear Escuela' : 'Editar Escuela' }}
        </h3>

        <!-- Campos principales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ([
                'nombre' => 'Nombre',
                'direccion' => 'Dirección',
                'telefono' => 'Teléfono',
                'codigo_mined' => 'Código MINED',
                'municipio' => 'Municipio',
                'departamento' => 'Departamento',
                'pais' => 'País',
                'tipo' => 'Tipo',
                'anio_fundacion' => 'Año Fundación',
                'director' => 'Director',
            ] as $campo => $label)
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-200">{{ $label }}</label>
                <input type="{{ $campo === 'anio_fundacion' ? 'number' : 'text' }}"
                    wire:model.defer="form.{{ $campo }}"
                    class="border rounded px-2 py-1 w-full
                           border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-900
                           text-gray-900 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500">
                @error('form.' . $campo)
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @endforeach
        </div>

        <!-- Grados -->
        <div class="mt-4">
            <h4 class="font-bold mb-2 text-gray-900 dark:text-gray-100">Grados</h4>
            <div class="flex flex-col gap-2">
                @foreach ($form['grados'] as $index => $grado)
                <div class="flex flex-col sm:flex-row gap-2 items-end bg-gray-50 dark:bg-gray-700/50 p-2 rounded">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre</label>
                        <input type="text" wire:model.defer="form.grados.{{ $index }}.nombre"
                            class="border rounded px-2 py-1 w-full
                                   border-gray-300 dark:border-gray-600
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-gray-100">
                        @error('form.grados.' . $index . '.nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Descripción</label>
                        <input type="text" wire:model.defer="form.grados.{{ $index }}.descripcion"
                            class="border rounded px-2 py-1 w-full
                                   border-gray-300 dark:border-gray-600
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-gray-100">
                    </div>
                    <div class="w-full sm:w-20">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Orden</label>
                        <input type="number" wire:model.defer="form.grados.{{ $index }}.orden"
                            class="border rounded px-2 py-1 w-full
                                   border-gray-300 dark:border-gray-600
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-gray-100">
                    </div>
                    <button type="button" wire:click="removeGrado({{ $index }})"
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 w-full sm:w-auto transition">Eliminar</button>
                </div>
                @endforeach
            </div>
            <button type="button" wire:click="addGrado"
                class="mt-2 bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 w-full sm:w-auto transition">
                Agregar Grado
            </button>
        </div>

        <!-- Botones -->
        <div class="mt-4 flex flex-col sm:flex-row justify-end gap-2 pb-24 sm:pb-6">
            <button wire:click="$set('isOpen', false)"
                class="px-4 py-1 rounded border border-gray-300 dark:border-gray-600 
                       text-gray-700 dark:text-gray-200
                       hover:bg-gray-100 dark:hover:bg-gray-700 
                       w-full sm:w-auto transition">Cancelar</button>
            <button wire:click="guardar"
                class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 w-full sm:w-auto transition">
                Guardar
            </button>
        </div>
    </div>
</div>
@endif


    <!-- Modal Confirmación Eliminar -->
    @if ($modalConfirmar)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-bold mb-4">Confirmar eliminación</h3>
            <p class="mb-4">¿Está seguro que desea eliminar esta escuela?</p>
            <div class="flex justify-end gap-2">
                <button wire:click="$set('modalConfirmar', false)"
                    class="px-4 py-1 rounded border hover:bg-gray-100">Cancelar</button>
                <button wire:click="eliminarConfirmado"
                    class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

</div>