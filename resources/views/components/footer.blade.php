<footer class="bg-gradient-to-r from-green-50 via-blue-50 to-green-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-700 dark:text-gray-300 py-8 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-6 items-start text-center md:text-left">

        {{-- Columna 1: Logo y nombre de Sentec --}}
        <div class="flex flex-col items-center md:items-start">
            <div class="flex items-center gap-2">
                <img src="{{ asset('logo-sentec.png') }}" alt="Sentec Logo" class="w-12 h-12">
                <span class="text-2xl font-bold text-green-700 dark:text-green-400">SENTEC</span>
            </div>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 max-w-xs">
                Plataforma educativa inclusiva que democratiza el aprendizaje de las matemáticas con tecnología y lenguaje de señas.
            </p>
        </div>

        {{-- Columna 2: Sobre Sentec --}}
        <div class="hidden md:flex flex-col items-center md:items-start space-y-2 text-sm text-gray-600 dark:text-gray-400">
            <p class="font-semibold text-gray-700 dark:text-gray-300">Sobre la plataforma:</p>
            <p>Sentec permite a los estudiantes acceder a contenido educativo de calidad, integrando accesibilidad y tecnología de manera innovadora.</p>
            <p>Optimizado para inclusión y aprendizaje activo, con seguimiento de progreso y herramientas adaptadas a cada estudiante.</p>
        </div>

        {{-- Columna 3: Configuración Admin --}}
        @if(Auth::user() && Auth::user()->hasRole('Administrador'))
            <div class="flex flex-col items-center md:items-end space-y-2">
                <livewire:footer-configuracion />
            </div>
        @endif
    </div>

    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 text-center text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} SENTEC. Todos los derechos reservados. 🌐
    </div>
</footer>
