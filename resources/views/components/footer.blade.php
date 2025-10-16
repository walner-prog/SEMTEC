<footer class="bg-blue-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 py-12 transition-colors">
    <div
        class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-10 items-start text-center md:text-left">

        {{-- Columna 1: Logo y descripción --}}
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('img/logo/logo.png') }}" alt="SEMTEC Logo" class="w-32 h-28 mb-4 drop-shadow-lg">
            <p class="text-sm max-w-xs leading-relaxed">
                SEMTEC es una plataforma inclusiva que democratiza el aprendizaje de las matemáticas en primaria,
                integrando accesibilidad, IA y gamificación.
            </p>
        </div>

        {{-- Columna 2: Enlaces legales --}}
        <div class="flex flex-col items-center md:items-start space-y-2">
            <h3 class="font-semibold text-lg mb-2">Enlaces útiles</h3>
            <a href="{{ route('politicas') }}" class="text-sm hover:underline flex items-center gap-2">
                <i class="fa-solid fa-shield-halved"></i> Políticas de Privacidad
            </a>

            <a href="{{ route('condiciones') }}" class="text-sm hover:underline flex items-center gap-2">
                <i class="fa-solid fa-file-contract"></i> Condiciones de Uso
            </a>
            <a href="{{ route('contacto') }}" class="text-sm hover:underline flex items-center gap-2">
                <i class="fa-solid fa-envelope"></i> Contacto
            </a>
        </div>

        {{-- Columna 3: Redes sociales --}}
        <div class="flex flex-col items-center md:items-start">
            <h3 class="font-semibold text-lg mb-4">Conéctate con nosotros</h3>
            <div class="flex gap-6 text-2xl">
                <a href="#" aria-label="Facebook" class="hover:text-blue-500 transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="mailto:info@semtec.org" aria-label="Email" class="hover:text-yellow-400 transition">
                    <i class="fa-solid fa-envelope"></i>
                </a>
                <a href="#" aria-label="YouTube" class="hover:text-red-500 transition">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Línea inferior --}}
    <div class="mt-10 pt-6 border-t border-gray-300 dark:border-gray-700 text-center text-sm">
        &copy; {{ date('Y') }} <span class="font-semibold">SEMTEC</span>. Todos los derechos reservados.
    </div>
    <br>
</footer>