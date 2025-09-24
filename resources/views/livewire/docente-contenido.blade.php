<div>




    <div class="fixed top-5 right-5 space-y-2 z-50">
        @foreach (['create' => 'green', 'update' => 'yellow', 'delete' => 'red', 'error' => 'red'] as $type => $color)
        @if (session()->has($type))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-20px] opacity-0"
            class="max-w-xs w-full border-l-4 border-{{ $color }}-500 bg-{{ $color }}-100 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200 p-4 rounded shadow-md flex items-start gap-2">
            <span class="font-semibold capitalize">{{ $type }}:</span>
            <span class="flex-1 text-sm">{{ session($type) }}</span>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        @endif
        @endforeach
    </div>


    {{-- Modal Crear/Editar --}}
    @if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 px-4">
        <div
            class="bg-white dark:bg-gray-800 w-full max-w-3xl p-6 rounded-2xl shadow-2xl overflow-y-auto max-h-[90vh] relative">

            {{-- Botón cerrar --}}
            <button type="button" wire:click="$set('isOpen', false)"
                class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-red-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>

            {{-- Error --}}
            @if (session()->has('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                class="bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 p-3 mb-4 rounded-lg shadow-md flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
            @endif

            {{-- Título --}}
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-gray-100">
                <i
                    class="fas {{ $modo === 'crear' ? 'fa-plus-circle text-green-600' : 'fa-edit text-yellow-500' }}"></i>
                {{ $modo === 'crear' ? 'Crear Contenido' : 'Editar Contenido' }}
            </h2>

            {{-- Wizard pasos --}}
            <div class="mb-6 flex justify-between">
                <span
                    class="flex items-center gap-2 px-4 py-2 rounded-full 
                {{ $step==1 ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                    <i class="fas fa-book"></i> Unidad
                </span>
                <span
                    class="flex items-center gap-2 px-4 py-2 rounded-full 
                {{ $step==2 ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                    <i class="fas fa-lightbulb"></i> Competencias
                </span>
                <span
                    class="flex items-center gap-2 px-4 py-2 rounded-full 
                {{ $step==3 ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                    <i class="fas fa-check-circle"></i> Indicadores
                </span>
                <span
                    class="flex items-center gap-2 px-4 py-2 rounded-full 
                {{ $step==4 ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                    <i class="fas fa-tasks"></i> Actividades
                </span>
            </div>

            <form class="space-y-4">

                {{-- Paso 1: Unidad --}}
                @if($step === 1)
                <div class="space-y-3">
                    <div>
                        <label class="block font-medium">Título de la Unidad</label>
                        <input type="text" wire:model="form.unidad.titulo"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block font-medium">Descripción</label>
                        <textarea wire:model="form.unidad.descripcion"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                    <div>
                        <label class="block font-medium">Grado</label>
                        <select wire:model="form.unidad.grado_id"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">-- Seleccione --</option>
                            @foreach($grados as $grado)
                            <option value="{{ $grado['id'] }}">{{ $grado['nombre'] }}</option>
                            @endforeach
                        </select>
                        @error('form.unidad.grado_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif

                {{-- Paso 2: Competencias --}}
                @if($step === 2)
                <button type="button" wire:click="addCompetencia"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition">
                    <i class="fas fa-plus"></i> Añadir Competencia
                </button>

                @foreach($form['competencias'] as $i => $comp)
                <div class="mt-3 border p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <div class="flex items-center gap-2">
                        <input type="text" wire:model="form.competencias.{{ $i }}.titulo"
                            placeholder="Título competencia"
                            class="flex-1 border px-2 py-1 rounded-lg dark:bg-gray-600 dark:text-gray-200">
                        <button type="button" wire:click="removeCompetencia({{ $i }})"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
                @endif

                {{-- Paso 3: Indicadores --}}
                @if($step === 3)
                @foreach($form['competencias'] as $comp)
                <h3 class="font-semibold text-gray-700 dark:text-gray-200 mt-4">
                    <i class="fas fa-lightbulb text-yellow-500"></i> {{ $comp['titulo'] }}
                </h3>
                <button type="button" wire:click="addIndicador('{{ $comp['temp_id'] }}')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg mb-2">
                    <i class="fas fa-plus"></i> Indicador
                </button>

                @foreach($form['indicadores'][$comp['temp_id']] ?? [] as $j => $ind)
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" wire:model="form.indicadores.{{ $comp['temp_id'] }}.{{ $j }}.titulo"
                        placeholder="Título indicador"
                        class="flex-1 border px-2 py-1 rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <button type="button" wire:click="removeIndicador('{{ $comp['temp_id'] }}', {{ $j }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                @endforeach
                @endforeach
                @endif

                {{-- Paso 4: Actividades --}}
                @if($step === 4)
                @foreach($form['indicadores'] as $compId => $inds)
                @foreach($inds as $ind)
                <h3 class="font-semibold text-gray-700 dark:text-gray-200 mt-4">
                    <i class="fas fa-check-circle text-green-500"></i> {{ $ind['titulo'] }}
                </h3>
                <button type="button" wire:click="addActividad('{{ $ind['temp_id'] }}')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg mb-2">
                    <i class="fas fa-plus"></i> Actividad
                </button>

                @foreach($form['actividades'][$ind['temp_id']] ?? [] as $k => $act)
                <div class="border p-4 mt-3 rounded-lg bg-gray-50 dark:bg-gray-700 relative">
                    {{-- Botón eliminar --}}
                    <button type="button" wire:click="removeActividad('{{ $ind['temp_id'] }}', {{ $k }})"
                        class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-lg">
                        <i class="fas fa-trash"></i>
                    </button>

                    {{-- Título y objetivo --}}
                    <input type="text" wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.titulo"
                        placeholder="Título actividad"
                        class="w-full border px-2 py-1 rounded-lg dark:bg-gray-600 dark:text-gray-200 mb-2">

                    <textarea wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.objetivo"
                        placeholder="Objetivo"
                        class="w-full border px-2 py-1 rounded-lg dark:bg-gray-600 dark:text-gray-200 mb-2"></textarea>

                    {{-- Tipo --}}
                    <div class="mt-2">
                        <label class="block font-medium">Tipo de actividad</label>
                        <select wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.tipo"
                            class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                            <option value="practica">Práctica</option>
                            <option value="cronometro">Cronómetro</option>
                            <option value="problema">Problema</option>
                        </select>
                    </div>

                    {{-- Dificultades --}}
                    <div class="flex gap-4 mt-3">
                        <div class="flex-1">
                            <label class="block font-medium">Dificultad mínima</label>
                            <input type="number" min="1" max="5"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.dificultad_min"
                                class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                        </div>
                        <div class="flex-1">
                            <label class="block font-medium">Dificultad máxima</label>
                            <input type="number" min="1" max="5"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.dificultad_max"
                                class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                        </div>
                    </div>

                    {{-- Accesibilidad --}}
                    <div class="flex gap-6 mt-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.accesibilidad_flags.tts">
                            <i class="fas fa-volume-up text-blue-500"></i> Texto a voz
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.accesibilidad_flags.isn">
                            <i class="fas fa-universal-access text-purple-500"></i> Símbolos ISN
                        </label>
                    </div>

                    {{-- NUEVOS CAMPOS DE MEDIA --}}
                    <div class="mt-3">
                        <label class="block font-medium">Video (URL YouTube o MP4)</label>
                        <input type="text" wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.media_video"
                            placeholder="https://youtube.com/..."
                            class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                    </div>

                    <div class="mt-3">
                        <label class="block font-medium">Recurso (Imagen, PDF o PPT)</label>
                        <input type="text" wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.media_documento"
                            placeholder="https://example.com/recurso.pdf"
                            class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                    </div>

                    {{-- Ítems --}}
                    <h4 class="font-semibold mt-4"><i class="fas fa-list"></i> Ítems</h4>
                    <button type="button" wire:click="addItem('{{ $ind['temp_id'] }}', {{ $k }})"
                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg mb-2">
                        <i class="fas fa-plus"></i> Ítem
                    </button>

                    @foreach($form['actividades'][$ind['temp_id']][$k]['items'] ?? [] as $m => $item)
                    <div class="flex items-center gap-2 mt-2">
                        <input type="text"
                            wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.items.{{ $m }}.enunciado"
                            placeholder="Enunciado"
                            class="flex-1 border px-2 py-1 rounded-lg dark:bg-gray-600 dark:text-gray-200">
                        <button type="button" wire:click="removeItem('{{ $ind['temp_id'] }}', {{ $k }}, {{ $m }})"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div>
                        <input type="text"
                            wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.items.{{ $m }}.respuesta"
                            placeholder="Respuesta correcta"
                            class="w-full border px-2 py-1 rounded-lg dark:bg-gray-600 dark:text-gray-200">
                    </div>
                    @endforeach

                    {{-- Tiempo --}}
                    <div class="mt-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.con_tiempo">
                            <i class="fas fa-stopwatch text-red-500"></i> ¿Con límite de tiempo?
                        </label>

                        @if(!empty($form['actividades'][$ind['temp_id']][$k]['con_tiempo']))
                        <div class="mt-2">
                            <label class="block font-medium">Tiempo límite (minutos)</label>
                            <input type="number" min="1"
                                wire:model="form.actividades.{{ $ind['temp_id'] }}.{{ $k }}.limite_tiempo"
                                placeholder="Ejemplo: 30"
                                class="w-full border rounded-lg px-2 py-1 dark:bg-gray-600 dark:text-gray-200">
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endforeach
                @endforeach
                @endif


                {{-- Navegación --}}
                <div class="flex justify-between mt-6">
                    @if($step > 1)
                    <button type="button" wire:click="$set('step', {{ $step - 1 }})"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Atrás
                    </button>
                    @endif

                    @if($step < 4) <button type="button" wire:click="$set('step', {{ $step + 1 }})"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 ml-auto">
                        Siguiente <i class="fas fa-arrow-right"></i>
                        </button>
                        @else
                        <button type="submit" wire:click.prevent="{{ $modo === 'crear' ? 'guardar' : 'actualizar' }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 ml-auto">
                            <i class="fas fa-save"></i> Guardar todo
                        </button>

                        @endif
                </div>
            </form>
        </div>
    </div>
    @endif






    {{-- Tabla de Unidades --}}
   <div class="max-w-7xl mx-auto p-6 lg:p-8 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
            dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen rounded-2xl">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- 🔹 Sección principal (Gestión de Unidades) --}}
        <div class="lg:col-span-9 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition">
            <!-- Header -->
            <div
                class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="fas fa-layer-group text-blue-500"></i> Gestión de Unidades
                </h2>
                <div class="flex flex-wrap gap-3 items-center">
                    <!-- Buscador -->
                    <input type="text" wire:model.live="search" placeholder="Buscar por título..."
                        class="w-48 sm:w-64 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200 text-sm">

                    <!-- Filtro por grado -->
                    <select wire:model.live="grado_id"
                        class="border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200 text-sm">
                        <option value="">Todos los grados</option>
                        @foreach($grados as $grado)
                            <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                        @endforeach
                    </select>

                    <!-- Per Page -->
                    <select wire:model.live="perPage"
                        class="border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-gray-200 text-sm">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                    </select>

                    <!-- Nuevo -->
                    <button wire:click="abrirModal"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                        <i class="fas fa-plus"></i> Nuevo Contenido
                    </button>
                </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-sm font-semibold uppercase tracking-wider">
                            <th class="p-4 text-left">#</th>
                            <th class="p-4 text-left">Título</th>
                            <th class="p-4 text-left">Grado</th>
                            <th class="p-4 text-left">Orden</th>
                            <th class="p-4 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($unidades as $index => $unidad)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-700 
                                               text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium">
                                        {{ $unidad->id }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $unidad->titulo }}</div>
                                    @if($unidad->descripcion)
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            {{ Str::limit($unidad->descripcion, 50) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($unidad->grado)
                                        <span
                                            class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                            {{ $unidad->grado->nombre }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-700 
                                               text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium">
                                        {{ $unidad->orden }}
                                    </span>
                                </td>
                                <td class="p-4 flex gap-2">
                                    <button wire:click="abrirModalVer({{ $unidad->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full"
                                        title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="abrirModalEditar({{ $unidad->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="abrirModalEliminar({{ $unidad->id }})"
                                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400 dark:text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="text-lg font-medium">No hay unidades registradas</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación y contador -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="text-gray-600 dark:text-gray-300 text-sm">
                    Mostrando <span class="font-medium">{{ $unidades->firstItem() }}</span> a
                    <span class="font-medium">{{ $unidades->lastItem() }}</span>
                    de <span class="font-medium">{{ $unidades->total() }}</span> unidades
                </div>
                <div class="mt-2 sm:mt-0">
                    {{ $unidades->links() }}
                </div>
            </div>
        </div>

        {{-- 🔹 Columna lateral Docente --}}
        <div class="lg:col-span-3 flex flex-col gap-6">
            <!-- Perfil docente -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shadow">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Docente</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <p><i class="fas fa-graduation-cap text-blue-500 mr-2"></i> {{ count($grados) }} grados asignados</p>
                    <p><i class="fas fa-book text-green-500 mr-2"></i> {{ $unidades->total() }} unidades creadas</p>
                    <p><i class="fas fa-star text-yellow-500 mr-2"></i> Nivel Experto</p>
                </div>
            </div>

            <!-- Tips para docentes -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-400"></i> Tips para docentes
                </h3>
                <ul class="mt-3 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Revisa el progreso de tus alumnos semanalmente</li>
                    <li><i class="fas fa-clock text-blue-500 mr-2"></i> Programa actividades con fechas claras</li>
                    <li><i class="fas fa-chart-line text-purple-500 mr-2"></i> Usa reportes para mejorar tu planificación</li>
                </ul>
            </div>
        </div>
    </div>
</div>







    @if($isViewOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div
            class="bg-white dark:bg-gray-900 rounded-lg w-11/12 md:w-3/4 lg:w-2/3 max-h-[90vh] overflow-y-auto p-6 relative">
            <h2 class="text-xl font-bold mb-4">Ver Unidad: {{ $formVer['unidad']['titulo'] ?? '' }}</h2>

            <p><strong>Descripción:</strong> {{ $formVer['unidad']['descripcion'] ?? '-' }}</p>
            <p><strong>Grado:</strong> {{ optional($unidadVer->grado)->nombre ?? '-' }}</p>
            <p><strong>Orden:</strong> {{ $formVer['unidad']['orden'] ?? 0 }}</p>

            @foreach($formVer['competencias'] as $comp)
            <details class="mt-4 border p-2 rounded bg-gray-50 dark:bg-gray-800">
                <summary class="font-semibold cursor-pointer">Competencia: {{ $comp['titulo'] }}</summary>
                <p>{{ $comp['descripcion'] ?? '-' }}</p>

                @foreach($formVer['indicadores'][$comp['temp_id']] ?? [] as $ind)
                <details class="ml-4 mt-2 border-l pl-2">
                    <summary class="font-medium cursor-pointer">Indicador: {{ $ind['titulo'] }}</summary>
                    <p>{{ $ind['descripcion'] ?? '-' }}</p>

                    @foreach($formVer['actividades'][$ind['temp_id']] ?? [] as $act)
                    <div class="ml-4 mt-1 border-l pl-2">
                        <p><strong>Actividad:</strong> {{ $act['titulo'] }}</p>
                        <p><strong>Objetivo:</strong> {{ $act['objetivo'] }}</p>
                        <p><strong>Tipo:</strong> {{ $act['tipo'] }}</p>
                        <p><strong>Dificultad:</strong> {{ $act['dificultad_min'] }} - {{ $act['dificultad_max'] }}</p>

                        @if(!empty($act['items']))
                        <ul class="ml-4 list-disc">
                            @foreach($act['items'] as $item)
                            <li>{{ $item['enunciado'] }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @endforeach
                </details>
                @endforeach
            </details>
            @endforeach

            <div class="mt-4 text-right">
                <button wire:click="cerrarModalVer" class="bg-gray-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>

            <button wire:click="cerrarModalVer"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">&times;</button>
        </div>
    </div>
    @endif



    @if($isDeleteModalOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-lg w-11/12 md:w-1/3 p-6 relative">
            <h2 class="text-lg font-bold mb-4">Confirmar Eliminación</h2>
            <p>¿Estás seguro que deseas eliminar la unidad <strong>{{ $unidadAEliminar->titulo ?? '' }}</strong>?</p>

            <div class="mt-4 flex justify-end gap-2">
                <button wire:click="cerrarModalEliminar"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button wire:click="confirmarEliminarUnidad"
                    class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
            </div>

            <!-- Cerrar con X -->
            <button wire:click="cerrarModalEliminar"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">&times;</button>
        </div>
    </div>
    @endif





</div>