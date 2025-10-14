<div class="p-2 lg:p-12 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
    dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

    <div>
        <button wire:click="abrirModalNotificaciones" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ver Notificaciones
        </button>

        @if($modalNotificaciones)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-11/12 md:w-2/3 max-h-[80vh] overflow-y-auto p-5">
                @if(session()->has('success'))
                <div class="bg-green-500 text-white px-3 py-2 rounded mb-2">{{ session('success') }}</div>
                @endif

                @if(session()->has('error'))
                <div class="bg-red-500 text-white px-3 py-2 rounded mb-2">{{ session('error') }}</div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Notificaciones</h3>
                    <button wire:click="cerrarModalNotificaciones"
                        class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>



                <ul class="space-y-3">
                    @foreach($notificaciones as $notificacion)
                    <li
                        class="relative flex justify-between items-start gap-3 p-3 rounded-lg border
                         {{ $notificacion->read_at ? 'bg-gray-50 dark:bg-gray-700' : 'bg-blue-50 dark:bg-blue-900 border-blue-400' }}">

                        <div class="flex items-start gap-3">

                            <div>
                                <p class="text-sm font-medium">{{ $notificacion->titulo }}</p>
                                <p class="text-xs text-gray-500">{{ $notificacion->mensaje }}</p>
                                <p class="text-[10px] text-gray-400">{{ $notificacion->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            @if(!$notificacion->read_at)
                            <button wire:click="marcarLeida('{{ $notificacion->id }}')"
                                class="text-xs text-blue-600 hover:underline">Marcar leída</button>
                            @endif
                            <button wire:click="seleccionarNotificacion('{{ $notificacion->id }}')"
                                class="text-xs text-green-600 hover:underline">Responder</button>
                        </div>

                        <!-- Toast individual -->
                        <div x-data="{ show: @entangle('toasts.'.$notificacion->id).defer }" x-show="show" x-transition
                            x-init="if(show){setTimeout(()=>show=false,3000)}"
                            class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 rounded shadow text-xs">
                            Respuesta enviada
                        </div>
                    </li>
                    @endforeach
                </ul>


                @if($notificacionSeleccionada)
                <div class="mt-4">
                    <textarea wire:model.defer="respuesta" placeholder="Escribe tu respuesta..."
                        class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white"></textarea>
                    <button wire:click="responderTutor" class="mt-2 bg-green-600 text-white px-4 py-2 rounded">
                        Enviar respuesta
                    </button>



                </div>
                @endif
            </div>
        </div>
        @endif
    </div>


    <!-- Header con nombre del docente -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-3">
            <i class="fas fa-chalkboard-teacher text-blue-600 dark:text-blue-400"></i>
            Bienvenido, {{ auth()->user()->name }}
        </h1>
        <div
            class="mt-4 md:mt-0 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <i class="fas fa-lightbulb text-yellow-300"></i>
            <span class="font-semibold">Tip: Inspira y guía a tus estudiantes 🚀</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Sección principal (tabla) -->
        <div class="lg:col-span-3 hidden sm:block">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800 dark:text-gray-100">
                    <i class="fas fa-chart-line text-green-500"></i> Desempeño por competencia
                </h2>

                <!-- Filtros -->
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <input type="text" wire:model.live.debounce.500ms="filtroEstudiante"
                        placeholder="🔍 Filtrar por estudiante..."
                        class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 p-2 rounded-lg w-full md:w-1/2 focus:ring-2 focus:ring-blue-400 outline-none">

                    <select wire:model.live="filtroGrado"
                        class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 p-2 rounded-lg w-full md:w-1/2 focus:ring-2 focus:ring-purple-400 outline-none">
                        <option value="">📚 Todos los grados</option>
                        @foreach($grados as $grado)
                        <option value="{{ $grado }}">{{ $grado }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <th class="border p-3 text-left">👩‍🎓 Estudiante</th>
                                <th class="border p-3 text-center">📘 Grado</th>

                                <th class="border p-3 text-center">📑 Total Actividades</th>
                                <th class="border p-3 text-center">⭐ Puntaje promedio</th>
                                <th class="border p-3 text-center">📞 Contactar Tutor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resumenDesempeno as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="border p-3">{{ $item->estudiante->name }}</td>
                                <td class="border p-3 text-center">{{ $item->grado }}</td>
                                <td class="border p-3 text-center">{{ $item->total_actividades }}</td>
                                <td class="border p-3 text-center font-semibold text-green-600 dark:text-green-400">
                                    {{ $item->puntaje_promedio }}%
                                </td>
                                <td class="border p-3 text-center">
                                    <button @if($item->estudiante->tutor_id)
                                        wire:click="abrirModalTutor('{{ $item->estudiante->tutor_id }}')"
                                        @else
                                        disabled
                                        @endif
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg"
                                        >
                                        📩 Notificar Tutor
                                    </button>


                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border p-3 text-center text-gray-500 dark:text-gray-400">No hay
                                    datos para mostrar</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $matriculas->links() }}
                </div>
            </div>
        </div>


        <!-- 📱 Sección móvil: desempeño por competencia -->
        <div class="block sm:hidden mt-4">
            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-bold mb-4 flex items-center gap-2 text-gray-800 dark:text-gray-100">
                    <i class="fas fa-chart-line text-green-500"></i>
                    Desempeño por competencia
                </h2>

                <!-- Filtros -->
                <div class="space-y-3 mb-4">
                    <input type="text" wire:model.live.debounce.500ms="filtroEstudiante"
                        placeholder="🔍 Filtrar por estudiante..." class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700
                       text-gray-800 dark:text-gray-100 p-2 rounded-lg w-full focus:ring-2
                       focus:ring-blue-400 outline-none">

                    <select wire:model.live="filtroGrado" class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700
                       text-gray-800 dark:text-gray-100 p-2 rounded-lg w-full focus:ring-2
                       focus:ring-purple-400 outline-none">
                        <option value="">📚 Todos los grados</option>
                        @foreach($grados as $grado)
                        <option value="{{ $grado }}">{{ $grado }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Cards compactas -->
                <div class="space-y-3">
                    @forelse($resumenDesempeno as $item)
                    <div
                        class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-3 shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-base">
                                👩‍🎓 {{ $item->estudiante->name }}
                            </h3>
                            <span
                                class="text-xs px-2 py-1 rounded-full bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-200 font-medium">
                                {{ $item->grado }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-700 dark:text-gray-200 space-y-1">
                            <p><strong>📑 Actividades:</strong> {{ $item->total_actividades }}</p>
                            <p><strong>⭐ Promedio:</strong>
                                <span class="font-semibold text-green-600 dark:text-green-400">
                                    {{ $item->puntaje_promedio }}%
                                </span>
                            </p>
                        </div>

                        <div class="mt-2 text-right">
                            <button @if($item->estudiante->tutor_id)
                                wire:click="abrirModalTutor('{{ $item->estudiante->tutor_id }}')"
                                @else disabled @endif
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm w-full
                                sm:w-auto transition">
                                📩 Notificar Tutor
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                        No hay datos para mostrar.
                    </div>
                    @endforelse
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $matriculas->links() }}
                </div>
            </div>
        </div>


        <!-- Card lateral -->
        <div class="lg:col-span-1 space-y-6">
            <div
                class="bg-gradient-to-r from-pink-400 to-red-500 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center">
                <i class="fas fa-trophy text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Reconocimientos</h3>
                <p class="text-sm text-center mt-2">Motiva a tus estudiantes con logros y trofeos. 💎</p>
            </div>

            <div
                class="bg-gradient-to-r from-blue-400 to-indigo-600 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center">
                <i class="fas fa-bell text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Notificaciones</h3>
                <p class="text-sm text-center mt-2">Mantente al día con recordatorios y avisos importantes. 🔔</p>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <!-- Modal Tutor -->
        @if($isModalTutorOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-6 relative">
                <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Notificar Tutor</h2>
                <p class="mb-2 text-gray-700 dark:text-gray-300">Teléfono del tutor: <span class="font-semibold">{{
                        $telefonoTutor }}</span></p>

                <!-- Input editable del mensaje -->
                <textarea wire:model.defer="mensajeTutor" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-2 mb-4 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Escribe tu mensaje aquí..."></textarea>

                <div class="flex justify-end gap-3">
                    <button wire:click="cerrarModalTutor"
                        class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-100 hover:bg-gray-400 dark:hover:bg-gray-500">
                        Cancelar
                    </button>
                    <button wire:click="enviarWhatsApp"
                        class="px-4 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white">
                        Enviar WhatsApp
                    </button>
                </div>
            </div>
        </div>
        @endif


    </div>
</div>