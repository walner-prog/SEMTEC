<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-2 text-gray-800 dark:text-gray-100">
            {{ $modulo['titulo'] }}
        </h2>

        <p class="text-gray-600 dark:text-gray-300 mb-4">
            <strong>Paso {{ $pasoActual + 1 }}:</strong> {{ $paso['titulo'] }}
        </p>

        <div class="border-l-4 border-blue-500 pl-4 mb-6">
            <p class="text-gray-700 dark:text-gray-200">{{ $paso['descripcion'] }}</p>
            <p class="mt-2 text-xs text-gray-400">ID referencial: {{ $paso['id'] }}</p>
        </div>

        {{-- Video dinámico --}}
        @if (!empty($paso['video']))
            <div class="mb-6 aspect-w-16 aspect-h-9">
                <iframe class="w-full h-64 rounded-lg shadow-md"
                        src="{{ $paso['video'] }}"
                        title="Video de {{ $paso['titulo'] }}"
                        allowfullscreen>
                </iframe>
            </div>
        @endif

        <div class="flex justify-between">
            <button wire:click="anteriorPaso" class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg">
                ← Anterior
            </button>

            <button wire:click="siguientePaso" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Siguiente →
            </button>
        </div>

        <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 text-center">
            Módulo {{ $moduloActual }} de {{ count($modulos) }}
        </div>
    </div>
</div>

