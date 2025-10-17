<div x-data="{ open: false }">
    <!-- Botón para abrir el modal -->
    <button 
        @click="open = true" 
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
        Importar Estudiantes
    </button>

    <!-- Modal -->
       <div 
        x-show="open" 
        x-transition
        class="fixed inset-0 z-50 flex items-start sm:items-center justify-center bg-black bg-opacity-50 p-4 overflow-auto"
        style="display: none;"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-6xl pb-24 p-6 relative overflow-auto">
            <!-- Cerrar modal -->
            <button 
                @click="open = false" 
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                ✕
            </button>

            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Importar Estudiantes desde CSV</h2>

            @if (session()->has('success'))
                <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-200">Archivo CSV</label>
                    <input type="file" wire:model="file" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" accept=".csv,.txt" />
                    @error('file') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200">Escuela</label>
                        <select wire:model="escuela_id" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Seleccione Escuela</option>
                            @foreach($escuelas as $escuela)
                                <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
                            @endforeach
                        </select>
                        @error('escuela_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-200">Grado</label>
                        <select wire:model="grado_id" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Seleccione Grado</option>
                            @foreach($grados as $grado)
                                <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                            @endforeach
                        </select>
                        @error('grado_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-200">Sección</label>
                        <input type="text" wire:model="seccion" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="A" />
                        @error('seccion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-200">Docente</label>
                        <select wire:model="docente_id" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Seleccione Docente</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}">{{ $docente->name }}</option>
                            @endforeach
                        </select>
                        @error('docente_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-gray-700 dark:text-gray-200">Tutor</label>
                        <select wire:model="tutor_id" class="border rounded w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Seleccione Tutor</option>
                            @foreach($tutores as $tutor)
                                <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                            @endforeach
                        </select>
                        @error('tutor_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button 
                        wire:click="import"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 transition">
                        Importar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
