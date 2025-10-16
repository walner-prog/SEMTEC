<div class="p-4 bg-gray-50 dark:bg-gray-900 min-h-screen">

    <div class="mb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Docentes</h2>

        <select wire:model.live="perPage" class="border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
            <option value="5000">5000</option>
        </select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($docentes as $docente)
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $docente->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $docente->email }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $docente->id }}</p>
            </div>
            <div class="mt-3">
                <button wire:click="verDetalle({{ $docente->id }})"
                    class="w-full bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition-colors">
                    Ver detalle
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $docentes->links() }}
    </div>

    {{-- Modal estudiantes --}}
    @if($showStudents)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-xl w-full p-6 relative overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                    Estudiantes del docente ID {{ $showStudents }}
                </h3>
                <button wire:click="cerrarDetalle"
                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors">
                    Cerrar
                </button>
            </div>

            @if($students->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-96 overflow-y-auto">
                @foreach($students as $student)
                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded shadow">
                    <h4 class="font-semibold text-gray-800 dark:text-gray-100">{{ $student->name }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $student->email }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-300">No tiene estudiantes asignados.</p>
            @endif
        </div>
    </div>
    @endif

</div>
