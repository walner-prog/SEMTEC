<div class="p-6 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 
            dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen grid-cols-8">

    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800 dark:text-gray-100 drop-shadow">
        🎓 Bienvenido {{ auth()->user()->name }}  
        <span class="block text-lg font-medium text-gray-600 dark:text-gray-400">
            Tu grado es: {{ $grado->nombre ?? 'Sin grado asignado' }}
        </span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- 🔹 Sección 1: Actividades --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-tasks text-blue-500"></i> Actividades
            </h3>

            {{-- Actividades Pendientes --}}
            <div class="mb-6">
                <h4 class="text-lg font-semibold mb-2 text-gray-600 dark:text-gray-400">Pendientes</h4>
                @if($actividadesPendientes->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400"></i> No tienes actividades pendientes 🎉
                    </p>
                @else
                    <ul class="space-y-2">
                        @foreach($actividadesPendientes as $act)
                            <li class="flex items-center gap-2 bg-blue-50 dark:bg-gray-700 rounded-lg p-2 shadow-sm">
                                <i class="fas fa-hourglass-half text-yellow-500"></i>
                                <div>
                                    <strong class="text-gray-800 dark:text-gray-200">{{ $act->titulo }}</strong>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $act->indicador->titulo }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Actividades Completadas --}}
            <div>
                <h4 class="text-lg font-semibold mb-2 text-gray-600 dark:text-gray-400">Completadas</h4>
                @if($actividadesCompletadas->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                        <i class="fas fa-info-circle text-gray-400"></i> No has completado ninguna actividad aún.
                    </p>
                @else
                    <ul class="space-y-2">
                        @foreach($actividadesCompletadas as $act)
                            <li class="flex items-center gap-2 bg-green-50 dark:bg-gray-700 rounded-lg p-2 shadow-sm">
                                <i class="fas fa-check text-green-600"></i>
                                <div>
                                    <strong class="text-gray-800 dark:text-gray-200">{{ $act->titulo }}</strong>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $act->indicador->titulo }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- 🔹 Sección 2: Trofeos & Bonificaciones --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-trophy text-yellow-400"></i> Trofeos & Bonificaciones
            </h3>

            <div class="flex flex-wrap gap-3">
                <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 px-3 py-2 rounded-lg shadow-md flex items-center gap-2">
                    <i class="fas fa-star"></i> Estrella Dorada
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-3 py-2 rounded-lg shadow-md flex items-center gap-2">
                    <i class="fas fa-gift"></i> Bonificación Extra
                </div>
                <div class="bg-pink-100 dark:bg-pink-900 text-pink-700 dark:text-pink-300 px-3 py-2 rounded-lg shadow-md flex items-center gap-2">
                    <i class="fas fa-medal"></i> Medalla de Esfuerzo
                </div>
            </div>

            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Gana más trofeos completando actividades y retos 💪
            </p>
        </div>

        {{-- 🔹 Sección 3: Retos --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <i class="fas fa-fire text-red-500"></i> Retos Activos
            </h3>

            <ul class="space-y-3">
                <li class="flex items-center justify-between bg-red-50 dark:bg-gray-700 rounded-lg p-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-bolt text-red-500"></i>
                        <span class="text-gray-800 dark:text-gray-200">Completar 5 actividades esta semana</span>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">2/5</span>
                </li>
                <li class="flex items-center justify-between bg-purple-50 dark:bg-gray-700 rounded-lg p-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-brain text-purple-500"></i>
                        <span class="text-gray-800 dark:text-gray-200">Resolver 3 retos matemáticos</span>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">1/3</span>
                </li>
                <li class="flex items-center justify-between bg-green-50 dark:bg-gray-700 rounded-lg p-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-book text-green-500"></i>
                        <span class="text-gray-800 dark:text-gray-200">Leer 2 artículos de apoyo</span>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">0/2</span>
                </li>
            </ul>
        </div>
    </div>
</div>
