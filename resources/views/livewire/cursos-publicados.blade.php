<div class="p-6 space-y-6">

    <h1 class="text-2xl font-bold dark:text-white"> Cursos Publicados</h1>

    {{-- 🔹 Buscador y filtro --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Buscar cursos..."
            class="w-full md:w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">

        <select wire:model.live="categoria"
            class="w-full md:w-1/4 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            <option value="">Todas las categorías</option>
            <option value="Inclusión">Inclusión</option>
            <option value="Tecnología">Tecnología</option>
            <option value="Negocios">Negocios</option>
        </select>
    </div>

    {{-- 🔹 Cursos publicados --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cursosPublicados as $curso)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col">
                <div class="p-4 flex-1">
                    <h3 class="text-lg font-semibold mb-2 dark:text-white">{{ $curso->titulo }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 truncate">{{ $curso->descripcion }}</p>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full dark:bg-blue-800 dark:text-blue-100">
                        {{ $curso->categoria }}
                    </span>
                </div>
                <div class="p-4 mt-auto">
                    <a href="{{ route('curso.ver', $curso->id) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                        Ver curso →
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500 dark:text-gray-400">No se encontraron cursos.</p>
        @endforelse
    </div>

    {{-- 🔹 Paginación --}}
    <div class="mt-6">
        {{ $cursosPublicados->links() }}
    </div>

</div>
