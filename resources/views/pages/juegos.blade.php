<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-app-layout>
      <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
        <main class="flex-grow bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Livewire Juegos -->
            <livewire:juegos />

            <!-- Sección Línea de Tiempo y Visual Kids -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

                <!-- Línea de Tiempo -->
                <div class="relative">
                    <h2 class="text-2xl sm:text-3xl font-bold text-center text-green-600 mb-6">🚀 Tu Progreso</h2>
                    <div class="border-l-4 border-green-500 ml-6 space-y-8 relative">

                        <!-- Paso 1 -->
                        <div class="ml-6 relative">
                            <div class="absolute -left-6 w-12 h-12 sm:w-14 sm:h-14 bg-green-500 rounded-full flex items-center justify-center shadow-xl animate-pulse">
                                <i class="fa-solid fa-star text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-green-600 text-sm sm:text-base">Gana Estrellas ⭐</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm">Cada nivel superado te da puntos de experiencia.</p>
                        </div>

                        <!-- Paso 2 -->
                        <div class="ml-6 relative">
                            <div class="absolute -left-6 w-12 h-12 sm:w-14 sm:h-14 bg-yellow-400 rounded-full flex items-center justify-center shadow-xl animate-bounce">
                                <i class="fa-solid fa-coins text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-yellow-500 text-sm sm:text-base">Consigue Monedas 🪙</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm">Acumula monedas y desbloquea juegos secretos.</p>
                        </div>

                        <!-- Paso 3 -->
                        <div class="ml-6 relative">
                            <div class="absolute -left-6 w-12 h-12 sm:w-14 sm:h-14 bg-blue-500 rounded-full flex items-center justify-center shadow-xl animate-pulse">
                                <i class="fa-solid fa-trophy text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-blue-500 text-sm sm:text-base">Gana Trofeos 🏆</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm">Al superar grandes retos, obtienes trofeos especiales.</p>
                        </div>
                    </div>
                </div>

                <!-- Estilo Duolingo / Visual Kids -->
                <div class="text-center space-y-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-green-600">🌟 Diversión + Aprendizaje</h2>
                    <p class="text-gray-700 dark:text-gray-300 text-sm sm:text-base">Cada partida es una aventura mágica que hace crecer tus habilidades.</p>

                    <!-- Íconos Grandes -->
                    <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mt-6">
                        <div class="bg-pink-500 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center shadow-lg hover:scale-110 transition">
                            <i class="fa-solid fa-heart text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <div class="bg-purple-500 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center shadow-lg hover:rotate-12 transition">
                            <i class="fa-solid fa-dragon text-white text-2xl sm:text-3xl"></i>
                        </div>
                        <div class="bg-orange-500 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center shadow-lg hover:scale-110 transition">
                            <i class="fa-solid fa-hat-wizard text-white text-2xl sm:text-3xl"></i>
                        </div>
                    </div>

                    <!-- Mensaje motivador -->
                    <p class="text-base sm:text-lg font-bold text-green-600 mt-4 animate-pulse">¡Aprender es un juego lleno de magia! ✨</p>
                </div>
            </div>

            <!-- Sección Recompensas Épicas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

                <!-- Cofre de tesoro / Recompensas -->
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <div class="w-32 h-32 sm:w-40 sm:h-40 bg-yellow-400 rounded-3xl shadow-2xl flex items-center justify-center ">
                            <i class="fa-solid fa-treasure-chest text-white text-5xl sm:text-6xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 sm:-top-4 sm:-right-4 bg-pink-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm shadow-lg">
                            🎁 Recompensas
                        </div>
                    </div>
                    <h3 class="mt-6 text-xl sm:text-2xl font-bold text-yellow-500">¡Descubre sorpresas mágicas!</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm sm:text-base">
                        Cada logro desbloquea cofres con ⭐, 🪙 y premios secretos.
                    </p>
                </div>

                <!-- Ranking / Meta final -->
                <div class="flex flex-col items-center text-center mt-8 md:mt-0">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 bg-gradient-to-r from-green-400 to-blue-500 rounded-full shadow-xl flex items-center justify-center animate-spin-slow">
                        <i class="fa-solid fa-medal text-white text-5xl sm:text-6xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl sm:text-2xl font-bold text-green-600">¡Conviértete en Campeón! 🏆</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm sm:text-base">
                        Escala posiciones, gana medallas y demuestra que las matemáticas son tu superpoder ✨.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>




       



    </x-app-layout>
</body>

</html>