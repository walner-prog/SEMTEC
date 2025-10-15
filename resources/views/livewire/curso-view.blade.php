<div class="flex flex-col md:flex-row max-w-8xl mx-auto py-10 px-4 gap-8">

    {{-- Contenido principal --}}
    <main class="w-full md:w-2/3 bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-8 flex flex-col gap-6" tabindex="0">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 leading-snug">
            {{ $curso->titulo }}
        </h1>

        @if($leccionActual)
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
                {{ $leccionActual->titulo }}
            </h2>

            {{-- Video accesible con teclado y lectores de pantalla --}}
            @if(!empty($leccionActual->youtube_url))
                <div class="mb-6 aspect-video rounded-xl overflow-hidden shadow-inner">
                    <iframe
                        wire:key="video-{{ $indiceActual }}"
                        class="w-full h-full"
                        src="{{ \App\Livewire\CursoView::youtubeEmbedUrl($leccionActual->youtube_url) }}"
                        frameborder="0"
                        allowfullscreen
                        title="Video de la lección {{ $leccionActual->titulo }}"
                        tabindex="0">
                    </iframe>
                </div>
            @endif

            {{-- Contenido con lenguaje inclusivo sugerido --}}
            <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 flex-1 overflow-auto leading-relaxed">
                {!! nl2br(e($leccionActual->descripcion)) !!}
                {{-- Ejemplo de mejora con lenguaje inclusivo --}}
                <p class="mt-4 text-gray-800 dark:text-gray-200">
                    📌 Recordá que todas las personas pueden aprender a su ritmo y sentirse cómodas participando en esta lección. 
                </p>
            </div>

            {{-- Navegación con soporte teclado y focus visible --}}
            <div class="flex justify-between mt-8 gap-4">
                <button
                    wire:click="anterior"
                    @disabled($indiceActual == 0)
                    class="px-5 py-3 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition"
                    aria-label="Lección anterior"
                    tabindex="0">
                    ⬅️ Anterior
                </button>

                <button
                    wire:click="siguiente"
                    @disabled($indiceActual >= count($lecciones) - 1)
                    class="px-5 py-3 rounded-xl bg-blue-600 text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition"
                    aria-label="Siguiente lección"
                    tabindex="0">
                    Siguiente ➡️
                </button>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">No hay lecciones disponibles.</p>
        @endif
    </main>

    {{-- Sidebar de lecciones con navegación por teclado --}}
    <aside class="w-full md:w-1/3 bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 h-[80vh] overflow-y-auto md:sticky md:top-10" tabindex="0">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Lecciones</h2>
        <ul class="space-y-3">
            @foreach($lecciones as $index => $leccion)
                <li>
                    <button
                        wire:click="seleccionarLeccion({{ $index }})"
                        class="w-full text-left px-4 py-3 rounded-xl text-sm md:text-base transition 
                               {{ $indiceActual === $index
                                    ? 'bg-blue-600 text-white font-semibold shadow'
                                    : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-gray-700' }}"
                        aria-current="{{ $indiceActual === $index ? 'step' : '' }}"
                        tabindex="0"
                        aria-label="Lección {{ $loop->iteration }}: {{ $leccion->titulo }}">
                        {{ $loop->iteration }}. {{ $leccion->titulo }}
                    </button>
                </li>
            @endforeach
        </ul>

        {{-- Nota inclusiva --}}
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            💡 Todas las lecciones están diseñadas para personas de diferentes capacidades y estilos de aprendizaje.
        </p>
    </aside>
</div>
