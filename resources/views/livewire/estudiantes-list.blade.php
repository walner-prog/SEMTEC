<div class="p-4">

<div class="hidden sm:block bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300 p-4 rounded-lg shadow-inner">

    <!-- 🔹 Filtros y buscador -->
    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-4 flex-wrap">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="🔍 Buscar estudiante..."
            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full sm:w-64 bg-white dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">

        <select wire:model.live="escuelaFilter"
            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full sm:w-48 bg-white dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <option value="">🏫 Todas las Escuelas</option>
            @foreach($escuelas as $escuela)
                <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
            @endforeach
        </select>

        <select wire:model.live="gradoFilter"
            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full sm:w-48 bg-white dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <option value="">🎓 Todos los Grados</option>
            @foreach($grados as $grado)
                <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
            @endforeach
        </select>

        <select wire:model.live="anioFilter"
            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full sm:w-48 bg-white dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <option value="">📅 Todos los Años</option>
            @foreach($anios as $anio)
                <option value="{{ $anio }}">{{ $anio }}</option>
            @endforeach
        </select>

        <select wire:model.live="perPage"
            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full sm:w-32 bg-white dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            @foreach($perPageOptions as $option)
                <option value="{{ $option }}">Mostrar {{ $option }}</option>
            @endforeach
        </select>

         <livewire:import-estudiantes />
    </div>

    <!-- 🔸 Tabla de estudiantes -->
    <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
        <table class="min-w-full border-collapse bg-white dark:bg-gray-800 transition-colors duration-300">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr class="text-left">
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Nombre</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Escuela</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Grado</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Sección</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Año</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Docente</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Fecha Matrícula</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matriculas as $matricula)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-4 py-2">{{ $matricula->estudiante->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $matricula->escuela->nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $matricula->grado->nombre ?? $matricula->grado }}</td>
                        <td class="px-4 py-2">{{ $matricula->seccion }}</td>
                        <td class="px-4 py-2">{{ $matricula->anio }}</td>
                        <td class="px-4 py-2">{{ $matricula->docente->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $matricula->fecha_matricula?->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $matricula->observaciones }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            No se encontraron estudiantes.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔹 Paginación -->
    <div class="mt-4">
        {{ $matriculas->links() }}
    </div>
</div>



    <div
        class="p-3 space-y-3 block sm:hidden bg-gray-50 dark:bg-gray-900 min-h-screen text-gray-800 dark:text-gray-100 transition-colors duration-300">

        {{-- 🔹 Botón para mostrar/ocultar filtros --}}
        <div x-data="{ open: false }" class="mb-3">
            <button @click="open = !open"
                class="w-full flex justify-between items-center px-3 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-lg shadow hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                <span class="font-semibold">🎯 Filtros de búsqueda</span>
                <i :class="open ? 'fa fa-chevron-up' : 'fa fa-chevron-down'"></i>
            </button>

            {{-- 🔸 Panel de filtros --}}
            <div x-show="open" x-transition
                class="mt-2 bg-white dark:bg-gray-800 p-3 rounded-lg shadow border border-gray-200 dark:border-gray-700 space-y-3">

                <input type="text" wire:model.live.debounce.300ms="search" placeholder="🔍 Buscar estudiante..."
                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full bg-gray-50 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">

                <select wire:model.live="escuelaFilter"
                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full bg-gray-50 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">🏫 Todas las Escuelas</option>
                    @foreach($escuelas as $escuela)
                    <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="gradoFilter"
                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full bg-gray-50 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">🎓 Todos los Grados</option>
                    @foreach($grados as $grado)
                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model.live="anioFilter"
                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full bg-gray-50 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">📅 Todos los Años</option>
                    @foreach($anios as $anio)
                    <option value="{{ $anio }}">{{ $anio }}</option>
                    @endforeach
                </select>

                <select wire:model.live="perPage"
                    class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 w-full bg-gray-50 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    @foreach($perPageOptions as $option)
                    <option value="{{ $option }}">Mostrar {{ $option }}</option>
                    @endforeach
                </select>

                  <livewire:import-estudiantes />
            </div>
        </div>

        {{-- 🔹 Cards compactas (modo oscuro incluido) --}}
        <div class="grid gap-3">
            @forelse($matriculas as $matricula)
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow p-3 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-lg text-blue-600 dark:text-blue-400">
                        {{ $matricula->estudiante->name ?? '—' }}
                    </h2>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $matricula->anio }}</span>
                </div>

                <div class="text-sm mt-2 space-y-1 text-gray-700 dark:text-gray-200">
                    <p><strong>🏫 Escuela:</strong> {{ $matricula->escuela->nombre ?? '—' }}</p>
                    <p><strong>🎓 Grado:</strong> {{ $matricula->grado->nombre ?? $matricula->grado }}</p>
                    <p><strong>🧩 Sección:</strong> {{ $matricula->seccion ?? '—' }}</p>
                    <p><strong>👨‍🏫 Docente:</strong> {{ $matricula->docente->name ?? '—' }}</p>
                    <p><strong>📅 Matrícula:</strong> {{ $matricula->fecha_matricula?->format('d/m/Y') ?? '—' }}</p>
                    @if($matricula->observaciones)
                    <p><strong>🗒 Observaciones:</strong> {{ $matricula->observaciones }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                No se encontraron estudiantes.
            </div>
            @endforelse
        </div>

        {{-- 🔸 Paginación --}}
        <div class="mt-3">
            {{ $matriculas->links() }}
        </div>
    </div>


</div>