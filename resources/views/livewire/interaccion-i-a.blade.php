<div>


    <!-- Botón para abrir modal de sugerencias -->
    <button wire:click="abrirModalSugerencias"
        class="bg-yellow-400 mt-3 text-white px-4 py-2 rounded mb-2 hover:bg-yellow-500 flex items-center gap-2">
        <i class="fas fa-lightbulb"></i> Ver sugerencias
    </button>

    <!-- Modal de interacción -->
  @if($modalAbierto)
<div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-11/12 md:w-2/3 p-5 relative transition-colors">
        <button wire:click="cerrarModal"
            class="absolute top-2 right-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white text-xl">&times;</button>

        <h2 class="text-xl font-bold mb-3">Interacción con la IA 🤖</h2>

        <div class="respuesta-ia p-3 bg-yellow-50 dark:bg-gray-900 rounded mb-3 max-h-96 overflow-y-auto text-sm dark:text-yellow-200">
            @if($cargando)
            <div class="text-center text-gray-600 dark:text-gray-300">⏳ La IA está pensando...</div>
            @else
            {!! $respuestaIA !!}
            @endif
        </div>

        @if(!$cargando && $respuestaIA)
        <button onclick="speakResponse()"
            class="mb-3 bg-blue-500 dark:bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-blue-500 flex items-center gap-2 transition">
            <i class="fas fa-volume-up"></i> Escuchar respuesta
        </button>
        @endif

        <div class="flex gap-2">
            <input type="text" wire:model.defer="mensaje" 
                   class="flex-1 border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" 
                   placeholder="Escribe tu pregunta o comentario">
            <button wire:click="enviarMensaje" 
                    class="bg-green-500 dark:bg-green-600 text-white px-4 py-2 rounded hover:bg-green-600 dark:hover:bg-green-500 transition">
                Enviar
            </button>
        </div>
    </div>
</div>
@endif

@if($modalSugerencias)
<div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 dark:text-gray-100 rounded-2xl shadow-lg w-11/12 md:w-1/2 p-6 relative transition-colors">
        <button wire:click="cerrarModalSugerencias"
            class="absolute top-3 right-3 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white text-2xl">&times;</button>
        
        <h3 class="text-2xl font-extrabold mb-5 text-center text-purple-600 dark:text-purple-400">💡 Qué puedes preguntarle a la IA</h3>

        <ul class="space-y-4">
            <li class="flex items-center gap-4 bg-yellow-50 dark:bg-yellow-900 p-3 rounded-lg shadow-sm dark:text-yellow-200">
                <span class="text-4xl">🍎</span>
                <span>Aprender la tabla del 3 usando frutas o dibujos y lenguaje de señas ✋🤚</span>
            </li>
            <li class="flex items-center gap-4 bg-green-50 dark:bg-green-900 p-3 rounded-lg shadow-sm dark:text-green-200">
                <span class="text-4xl">➖</span>
                <span>Explícame la resta de forma sencilla, con ejemplos visuales y señas 🖐️</span>
            </li>
            <li class="flex items-center gap-4 bg-blue-50 dark:bg-blue-900 p-3 rounded-lg shadow-sm dark:text-blue-200">
                <span class="text-4xl">💡</span>
                <span>Dame consejos para recordar los números usando señas y dibujos 🎨✋</span>
            </li>
            <li class="flex items-center gap-4 bg-pink-50 dark:bg-pink-900 p-3 rounded-lg shadow-sm dark:text-pink-200">
                <span class="text-4xl">🎯</span>
                <span>Hazme un mini reto de matemáticas fácil y divertido, con apoyo de señas 🖐️🤚</span>
            </li>
            <li class="flex items-center gap-4 bg-purple-50 dark:bg-purple-900 p-3 rounded-lg shadow-sm dark:text-purple-200">
                <span class="text-4xl">📚</span>
                <span>Aprender palabras en inglés con ejemplos y señas divertidas ✋🌟</span>
            </li>
        </ul>
    </div>
</div>
@endif

</div>

<script>
    function speakResponse() {
    const text = document.querySelector('.respuesta-ia').innerText;
    if ('speechSynthesis' in window) {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'es-ES';
        utterance.rate = 1;
        speechSynthesis.speak(utterance);
    } else {
        alert("Tu navegador no soporta lectura de voz 😅");
    }
}
</script>