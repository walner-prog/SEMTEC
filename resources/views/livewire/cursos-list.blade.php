<div class="p-6 space-y-4 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50
            dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen text-gray-900 dark:text-gray-100">

    <div class="flex justify-between items-center mb-4">
          @if(auth()->user()?->hasRole('Docente'))
        <h2 class="text-xl font-bold">📘 Gestión de Cursos</h2>
        <button wire:click="abrirModalCrear"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition dark:bg-blue-500 dark:hover:bg-blue-600">
            + Nuevo Curso
        </button>
        @endif
    </div>

     @if(auth()->user()?->hasRole('Docente'))

    <div class="overflow-x-auto">
        <table class="min-w-full border bg-white dark:bg-gray-800 rounded shadow text-gray-900 dark:text-gray-100">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-2 text-left">Título</th>
                    <th class="p-2 text-left">Docente</th>
                    <th class="p-2 text-left">Categoría</th>
                    <th class="p-2 text-center">Publicado</th>
                    <th style="width: 290px" class="p-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($misCursos as $curso)
                <tr class="border-t dark:border-gray-700">
                    <td class="p-2">{{ $curso->titulo }}</td>
                    <td class="p-2">{{ $curso->docente?->name ?? '—' }}</td>
                    <td class="p-2">{{ $curso->categoria }}</td>
                    <td class="p-2 text-center">
                        {{ $curso->publicado ? '✅' : '❌' }}
                    </td>
                    <td class="p-2 text-center space-x-2" style="width: 290px">
                        @if($curso->user_id === auth()->id())
                        <button wire:click="abrirModalEditar({{ $curso->id }})"
                            class="text-blue-600 hover:underline dark:text-blue-400">Editar</button>
                        <button wire:click="confirmarEliminar({{ $curso->id }})"
                            class="text-red-600 hover:underline dark:text-red-400">Eliminar</button>
                        <a href="{{ route('curso.ver', $curso->id) }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Ver
                        </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">No hay cursos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $misCursos->links() }}
    </div>

    @endif


    @livewire('cursos-publicados')



    {{-- Modal crear/editar --}}
    @if ($isOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div
            class="bg-white dark:bg-gray-900 w-full max-w-3xl rounded shadow-lg p-6 space-y-4 overflow-y-auto max-h-[90vh]">
            <h3 class="text-lg font-semibold mb-2">
                {{ $modo === 'crear' ? '🆕 Crear Curso' : '✏️ Editar Curso' }}
            </h3>

            {{-- Formulario de curso --}}
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium">Título</label>
                    <input type="text" wire:model.defer="titulo"
                        class="w-full border rounded p-2 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">
                    @error('titulo') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Descripción</label>
                    <textarea wire:model.defer="descripcion"
                        class="w-full border rounded p-2 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100"></textarea>
                    @error('descripcion') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Categoría</label>
                        <input type="text" wire:model.defer="categoria"
                            class="w-full border rounded p-2 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100">
                    </div>
                    <div class="flex items-center mt-6 space-x-2">
                        <input type="checkbox" wire:model.defer="publicado" id="publicado"
                            class="accent-blue-600 dark:accent-blue-500">
                        <label for="publicado">Publicado</label>
                    </div>
                </div>
            </div>

            {{-- Subformulario de lecciones --}}
            <div class="border-t pt-4 mt-4 border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold mb-2">🎓 Lecciones</h4>

                @foreach ($lecciones as $index => $leccion)
                <div class="border rounded p-3 mb-3 bg-gray-50 dark:bg-gray-800">
                    <div class="flex justify-between">
                        <span class="font-medium">Lección {{ $index + 1 }}</span>
                        <button wire:click="eliminarLeccion({{ $index }})"
                            class="text-red-500 dark:text-red-400 text-sm">Eliminar</button>
                    </div>

                    <div class="mt-2 space-y-2">
                        <input type="text" wire:model.defer="lecciones.{{ $index }}.titulo"
                            placeholder="Título de la lección"
                            class="w-full border rounded p-2 bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                        @error("lecciones.$index.titulo") <span class="text-red-600 dark:text-red-400 text-sm">{{
                            $message }}</span> @enderror

                        <textarea wire:model.defer="lecciones.{{ $index }}.descripcion" placeholder="Descripción breve"
                            class="w-full border rounded p-2 bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-100"></textarea>

                        <input type="text" wire:model.defer="lecciones.{{ $index }}.youtube_url"
                            placeholder="URL de YouTube"
                            class="w-full border rounded p-2 bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                        @error("lecciones.$index.youtube_url") <span class="text-red-600 dark:text-red-400 text-sm">{{
                            $message }}</span> @enderror

                        <input type="number" wire:model.defer="lecciones.{{ $index }}.orden" placeholder="Orden"
                            class="w-24 border rounded p-2 bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                    </div>
                </div>
                @endforeach

                <button wire:click="agregarLeccion"
                    class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition dark:bg-green-500 dark:hover:bg-green-600">
                    + Agregar Lección
                </button>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 mt-6">
                <button wire:click="$set('isOpen', false)"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-gray-100 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                    Cancelar
                </button>
                <button wire:click="guardar"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Guardar
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal eliminar --}}
    @if ($modalConfirmar)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded shadow-lg p-6">
            <p class="mb-4 text-gray-700 dark:text-gray-200">¿Seguro que deseas eliminar este curso?</p>
            <div class="flex justify-end gap-3">
                <button wire:click="$set('modalConfirmar', false)"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-gray-100 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                    Cancelar
                </button>
                <button wire:click="eliminarConfirmado"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>