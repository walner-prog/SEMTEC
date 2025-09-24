<div class="p-6 lg:p-12 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
    dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">

    <!-- Header con nombre del docente -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-3">
            <i class="fas fa-chalkboard-teacher text-blue-600 dark:text-blue-400"></i>
            Bienvenido, {{ auth()->user()->name }}
        </h1>
        <div class="mt-4 md:mt-0 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <i class="fas fa-lightbulb text-yellow-300"></i>
            <span class="font-semibold">Tip: Inspira y guía a tus estudiantes 🚀</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <!-- Sección principal (tabla) -->
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
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
                                <th class="border p-3 text-left">🎯 Competencia</th>
                                <th class="border p-3 text-center">📑 Total Actividades</th>
                                <th class="border p-3 text-center">⭐ Puntaje promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resumenDesempeno as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="border p-3">{{ $item->estudiante }}</td>
                                    <td class="border p-3 text-center">{{ $item->grado }}</td>
                                    <td class="border p-3">{{ $item->competencia }}</td>
                                    <td class="border p-3 text-center">{{ $item->total_actividades }}</td>
                                    <td class="border p-3 text-center font-semibold text-green-600 dark:text-green-400">
                                        {{ $item->puntaje_promedio }}%
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border p-3 text-center text-gray-500 dark:text-gray-400">No hay datos para mostrar</td>
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

        <!-- Card lateral -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-gradient-to-r from-pink-400 to-red-500 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center">
                <i class="fas fa-trophy text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Reconocimientos</h3>
                <p class="text-sm text-center mt-2">Motiva a tus estudiantes con logros y trofeos. 💎</p>
            </div>

            <div class="bg-gradient-to-r from-blue-400 to-indigo-600 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center">
                <i class="fas fa-bell text-4xl mb-3"></i>
                <h3 class="text-lg font-bold">Notificaciones</h3>
                <p class="text-sm text-center mt-2">Mantente al día con recordatorios y avisos importantes. 🔔</p>
            </div>
        </div>
    </div>
</div>
