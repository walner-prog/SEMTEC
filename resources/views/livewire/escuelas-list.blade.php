 
<div class="p-4">

    <!-- Encabezado y busqueda -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Escuelas</h2>
        <div class="flex gap-2">
            <input type="text" wire:model="search" placeholder="Buscar escuela..."
                class="border rounded px-2 py-1" />
            <button wire:click="abrirModalCrear"
                class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Crear Escuela</button>
        </div>
    </div>

    <!-- Tabla de escuelas -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Dirección</th>
                    <th class="px-4 py-2 border">Director</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($escuelas as $escuela)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $escuela->nombre }}</td>
                        <td class="px-4 py-2">{{ $escuela->direccion }}</td>
                        <td class="px-4 py-2">{{ $escuela->director }}</td>
                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <button wire:click="abrirModalEditar({{ $escuela->id }})"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Editar</button>
                                <button wire:click="confirmarEliminar({{ $escuela->id }})"
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">No se encontraron escuelas.</td>
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
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg w-3/4 max-w-2xl p-6">
                <h3 class="text-lg font-bold mb-4">
                    {{ $modo === 'crear' ? 'Crear Escuela' : 'Editar Escuela' }}
                </h3>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block font-medium">Nombre</label>
                        <input type="text" wire:model.defer="form.nombre"
                            class="border rounded px-2 py-1 w-full">
                        @error('form.nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Dirección</label>
                        <input type="text" wire:model.defer="form.direccion"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Teléfono</label>
                        <input type="text" wire:model.defer="form.telefono"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Código MINED</label>
                        <input type="text" wire:model.defer="form.codigo_mined"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Municipio</label>
                        <input type="text" wire:model.defer="form.municipio"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Departamento</label>
                        <input type="text" wire:model.defer="form.departamento"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">País</label>
                        <input type="text" wire:model.defer="form.pais"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Tipo</label>
                        <input type="text" wire:model.defer="form.tipo"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Año Fundación</label>
                        <input type="number" wire:model.defer="form.anio_fundacion"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Director</label>
                        <input type="text" wire:model.defer="form.director"
                            class="border rounded px-2 py-1 w-full">
                    </div>

                </div>

                <!-- Grados -->
                <div class="mt-4">
                    <h4 class="font-bold mb-2">Grados</h4>
                    @foreach ($form->grados as $index => $grado)
                        <div class="flex gap-2 mb-2 items-end">
                            <div class="flex-1">
                                <label class="block text-sm font-medium">Nombre</label>
                                <input type="text" wire:model.defer="form.grados.{{ $index }}.nombre"
                                    class="border rounded px-2 py-1 w-full">
                                @error('form.grados.' . $index . '.nombre')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex-1">
                                <label class="block text-sm font-medium">Descripción</label>
                                <input type="text" wire:model.defer="form.grados.{{ $index }}.descripcion"
                                    class="border rounded px-2 py-1 w-full">
                            </div>

                            <div class="w-20">
                                <label class="block text-sm font-medium">Orden</label>
                                <input type="number" wire:model.defer="form.grados.{{ $index }}.orden"
                                    class="border rounded px-2 py-1 w-full">
                            </div>

                            <button type="button" wire:click="form.removeGrado({{ $index }})"
                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Eliminar</button>
                        </div>
                    @endforeach

                    <button type="button" wire:click="form.addGrado"
                        class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Agregar Grado</button>
                </div>

                <!-- Botones -->
                <div class="mt-4 flex justify-end gap-2">
                    <button wire:click="$set('isOpen', false)"
                        class="px-4 py-1 rounded border hover:bg-gray-100">Cancelar</button>
                    <button wire:click="guardar"
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Guardar</button>
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
