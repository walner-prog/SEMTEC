<div>



    <button wire:click="abrirModalSugerencias"
        class="bg-yellow-400 mt-3 text-white px-4 py-2 rounded mb-2 hover:bg-yellow-500 flex items-center gap-2">
        <i class="fas fa-lightbulb"></i> Ver sugerencias
    </button>


    @if($modalAbierto)
    <div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
        <div x-data="{ fontSize: 16 }" :style="`font-size: ${fontSize}px`"
            class="bg-white dark:bg-gray-800 dark:text-gray-100 rounded-lg shadow-lg w-11/12 md:w-2/3 p-5 relative transition-colors">

            <button wire:click="cerrarModal"
                class="absolute top-2 right-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white text-xl">
                &times;
            </button>

            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-bold">Interacción con la IA 🤖</h2>

                <!-- Controles de accesibilidad -->
                <div class="flex items-center gap-2">
                    <button @click="fontSize = Math.min(fontSize + 2, 28)"
                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-3 py-1 text-sm font-bold transition"
                        title="Aumentar tamaño de letra (A+)">
                        A+
                    </button>
                    <button @click="fontSize = Math.max(fontSize - 2, 12)"
                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-3 py-1 text-sm font-bold transition"
                        title="Reducir tamaño de letra (A–)">
                        A–
                    </button>
                    <button @click="fontSize = 16"
                        class="bg-gray-400 hover:bg-gray-500 text-white rounded-full px-3 py-1 text-sm font-bold transition"
                        title="Restablecer tamaño">
                        🔄
                    </button>
                </div>
            </div>

            <div
                class="respuesta-ia p-3 bg-yellow-50 dark:bg-gray-900 rounded mb-3 max-h-96 overflow-y-auto dark:text-yellow-200">
                @if($cargando)
                <div class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-300 py-8">
                    <svg class="animate-spin h-8 w-8 text-yellow-500 mb-3" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span class="text-center">⏳ La IA está pensando...<br>Por favor esperá un momento</span>
                </div>
                @else
                <div x-transition.opacity.duration.500ms>
                    {!! $respuestaIA !!}
                </div>
                @endif
            </div>

            <div class="flex gap-2 items-center">
                <input type="text" wire:model.defer="mensaje" id="mensajeInput"
                    class="flex-1 border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                    placeholder="Escribe o habla tu pregunta">

             

         
                <button wire:click="enviarMensaje" wire:loading.attr="disabled" wire:target="enviarMensaje"
                    class="bg-green-500 dark:bg-green-600 text-white px-4 py-2 rounded hover:bg-green-600 dark:hover:bg-green-500 transition flex items-center gap-2">
                    <svg wire:loading wire:target="enviarMensaje" class="animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="enviarMensaje">Enviar</span>
                    <span wire:loading wire:target="enviarMensaje">Enviando...</span>
                </button>
            </div>

        </div>
    </div>
    @endif


    @if($modalSugerencias)
    <div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
        <div
            class="bg-white dark:bg-gray-800 dark:text-gray-100 rounded-2xl shadow-lg w-11/12 md:w-1/2 p-6 relative transition-colors">
            <button wire:click="cerrarModalSugerencias"
                class="absolute top-3 right-3 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white text-2xl">&times;</button>

            <h3 class="text-2xl font-extrabold mb-5 text-center text-purple-600 dark:text-purple-400">💡 Qué puedes
                preguntarle a la IA</h3>

            <ul class="space-y-4">
                <li
                    class="flex items-center gap-4 bg-yellow-50 dark:bg-yellow-900 p-3 rounded-lg shadow-sm dark:text-yellow-200">
                    <i class="fas fa-apple-alt text-yellow-500 text-3xl"></i>
                    <span>Aprender la tabla del 3 usando frutas o dibujos y lenguaje de señas</span>
                </li>

                <li
                    class="flex items-center gap-4 bg-green-50 dark:bg-green-900 p-3 rounded-lg shadow-sm dark:text-green-200">
                    <i class="fas fa-minus-circle text-green-500 text-3xl"></i>
                    <span>Explícame la resta de forma sencilla, con ejemplos visuales y señas</span>
                </li>

                <li
                    class="flex items-center gap-4 bg-blue-50 dark:bg-blue-900 p-3 rounded-lg shadow-sm dark:text-blue-200">
                    <i class="fas fa-lightbulb text-blue-500 text-3xl"></i>
                    <span>Dame consejos para recordar los números usando señas y dibujos</span>
                </li>

                <li
                    class="flex items-center gap-4 bg-pink-50 dark:bg-pink-900 p-3 rounded-lg shadow-sm dark:text-pink-200">
                    <i class="fas fa-puzzle-piece text-pink-500 text-3xl"></i>
                    <span>Hazme un mini reto de matemáticas fácil y divertido, con apoyo de señas</span>
                </li>

                <li
                    class="flex items-center gap-4 bg-purple-50 dark:bg-purple-900 p-3 rounded-lg shadow-sm dark:text-purple-200">
                    <i class="fas fa-language text-purple-500 text-3xl"></i>
                    <span>Aprender palabras en inglés con ejemplos y señas divertidas</span>
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
        alert("Tu navegador no soporta lectura de voz ");
    }
}
</script>


<script>
document.addEventListener('livewire:load', () => {
    inicializarReconocimientoVoz();
});

document.addEventListener('livewire:updated', () => {
    inicializarReconocimientoVoz();
});

function inicializarReconocimientoVoz() {
    const btnVoz = document.getElementById('btnVoz');
    const input = document.getElementById('mensajeInput');

    if (!btnVoz || !input) return;
    if (btnVoz.dataset.listenerAdded) return;
    btnVoz.dataset.listenerAdded = true;

    if (!('webkitSpeechRecognition' in window)) {
        alert('⚠️ Tu navegador no soporta reconocimiento de voz.\nUsá Google Chrome en escritorio.');
        return;
    }

    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'es-ES';
    recognition.continuous = false;
    recognition.interimResults = false;

    btnVoz.addEventListener('click', () => {
        try {
            recognition.start();
            btnVoz.classList.add('animate-pulse', 'bg-blue-700');
        } catch (err) {
            console.error('No se pudo iniciar reconocimiento:', err);
            alert('🎙️ No se pudo acceder al micrófono. Verificá permisos en tu navegador.');
        }
    });

    recognition.onresult = (event) => {
        const texto = event.results[0][0].transcript;
        input.value = texto;
        input.dispatchEvent(new Event('input'));
    };

    recognition.onend = () => {
        btnVoz.classList.remove('animate-pulse', 'bg-blue-700');
    };

    recognition.onerror = (e) => {
        console.error('Error reconocimiento de voz:', e.error);
        btnVoz.classList.remove('animate-pulse', 'bg-blue-700');

        if (e.error === 'not-allowed') {
            alert('🎙️ No se dio permiso para usar el micrófono.');
        }
    };
}
</script>
