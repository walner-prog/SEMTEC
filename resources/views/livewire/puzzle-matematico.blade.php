<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Rompecabezas Matemático 🧩</h2>

    @if($completado)
        <div class="p-4 bg-green-200 text-green-800 rounded mb-4">
            ¡Felicidades! 🎉 Formaste el animal correcto.
        </div>
    @endif

    <div class="grid grid-cols-2 gap-2">
        @foreach($piezas as $pieza)
            <div 
                class="bg-blue-300 text-white font-bold text-2xl h-24 flex items-center justify-center rounded cursor-pointer"
                x-data
                x-on:click="$wire.moverPieza({{ $pieza['id'] }}, {{ $loop->index }})"
                role="button"
                tabindex="0"
                aria-label="Pieza número {{ $pieza['numero'] }}"
            >
                {{ $pieza['numero'] }}
            </div>
        @endforeach
    </div>
</div>
