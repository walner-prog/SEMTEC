 
<div class="bg-white dark:bg-slate-900 text-gray-900 dark:text-slate-100 transition-colors duration-300">
    
    

    <main class="container mx-auto px-4 py-8" role="main">
        
          Progreso 
        <section class="mb-8" aria-labelledby="progress-heading">
            <div class="bg-gradient-to-br from-emerald-500 to-blue-500 rounded-3xl p-6 md:p-8 text-white shadow-2xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    
                      
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg" aria-hidden="true">
                            <i class="fas fa-user text-4xl text-emerald-500"></i>
                        </div>
                        <div>
                            <h2 id="progress-heading" class="text-3xl font-bold">¡Hola, {{ $user->name }}!</h2>
                            <p class="text-emerald-100 text-lg">Nivel 5 - Explorador</p>
                        </div>
                    </div>
                    
                     XP and Streak 
                    <div class="flex gap-6">
                         XP 
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 min-w-[120px] text-center">
                            <i class="fas fa-star text-3xl text-amber-300 mb-2" aria-hidden="true"></i>
                            <p class="text-4xl font-bold">850</p>
                            <p class="text-sm text-emerald-100">XP Total</p>
                        </div>
                        
                         Streak 
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 min-w-[120px] text-center">
                            <i class="fas fa-fire text-3xl text-orange-400 mb-2" aria-hidden="true"></i>
                            <p class="text-4xl font-bold">7</p>
                            <p class="text-sm text-emerald-100">Días seguidos</p>
                        </div>
                    </div>
                </div>
                
                 Progress Bar 
                <div class="mt-6" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" aria-label="Progreso al siguiente nivel">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold">Progreso al Nivel 6</span>
                        <span class="text-sm font-semibold">650 / 1000 XP</span>
                    </div>
                    <div class="w-full h-4 bg-white/30 rounded-full overflow-hidden">
                        <div class="h-full bg-white rounded-full transition-all duration-500" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </section>

         Quick Stats 
        <section class="mb-8" aria-labelledby="stats-heading">
            <h2 id="stats-heading" class="sr-only">Estadísticas rápidas</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
                 Challenges Completed 
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 text-center border-2 border-gray-200 dark:border-slate-700 hover:border-emerald-500 dark:hover:border-emerald-400 transition-all">
                    <i class="fas fa-check-circle text-5xl text-emerald-500 mb-3" aria-hidden="true"></i>
                    <p class="text-3xl font-bold text-gray-900 dark:text-slate-100">42</p>
                    <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">Retos completados</p>
                </div>
                
                 Rewards Earned 
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 text-center border-2 border-gray-200 dark:border-slate-700 hover:border-amber-500 dark:hover:border-amber-400 transition-all">
                    <i class="fas fa-trophy text-5xl text-amber-500 mb-3" aria-hidden="true"></i>
                    <p class="text-3xl font-bold text-gray-900 dark:text-slate-100">15</p>
                    <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">Recompensas</p>
                </div>
                
                 Perfect Scores 
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 text-center border-2 border-gray-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all">
                    <i class="fas fa-medal text-5xl text-blue-500 mb-3" aria-hidden="true"></i>
                    <p class="text-3xl font-bold text-gray-900 dark:text-slate-100">28</p>
                    <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">Puntajes perfectos</p>
                </div>
                
                 Time Spent 
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 text-center border-2 border-gray-200 dark:border-slate-700 hover:border-purple-500 dark:hover:border-purple-400 transition-all">
                    <i class="fas fa-clock text-5xl text-purple-500 mb-3" aria-hidden="true"></i>
                    <p class="text-3xl font-bold text-gray-900 dark:text-slate-100">12h</p>
                    <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">Tiempo de práctica</p>
                </div>
            </div>
        </section>

         Available Challenges 
        <section aria-labelledby="challenges-heading">
            <div class="flex items-center justify-between mb-6">
                <h2 id="challenges-heading" class="text-3xl font-bold text-gray-900 dark:text-slate-100">
                    Retos Disponibles
                </h2>
                <button class="touch-target px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-all focus-visible-ring flex items-center gap-2">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                    <span>Filtrar</span>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                 Challenge Card 1: Addition 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-emerald-200 dark:border-emerald-900 hover:border-emerald-500 dark:hover:border-emerald-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-plus text-4xl text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold">
                            +50 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Suma Divertida
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Practica sumas básicas con números del 1 al 20
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            10 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Fácil
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>

                 Challenge Card 2: Subtraction 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-blue-200 dark:border-blue-900 hover:border-blue-500 dark:hover:border-blue-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-minus text-4xl text-blue-600 dark:text-blue-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm font-semibold">
                            +75 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Resta Rápida
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Resuelve restas con números del 1 al 50
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            15 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Medio
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>

                 Challenge Card 3: Multiplication 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-purple-200 dark:border-purple-900 hover:border-purple-500 dark:hover:border-purple-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-times text-4xl text-purple-600 dark:text-purple-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-full text-sm font-semibold">
                            +100 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Tablas de Multiplicar
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Domina las tablas del 2 al 5
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            20 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Difícil
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-purple-500 hover:bg-purple-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>

                 Challenge Card 4: Geometry 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-amber-200 dark:border-amber-900 hover:border-amber-500 dark:hover:border-amber-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-shapes text-4xl text-amber-600 dark:text-amber-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900 text-amber-700 dark:text-amber-300 rounded-full text-sm font-semibold">
                            +60 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Formas Geométricas
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Identifica y cuenta figuras geométricas
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            12 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Fácil
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>

                 Challenge Card 5: Fractions 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-rose-200 dark:border-rose-900 hover:border-rose-500 dark:hover:border-rose-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-rose-100 dark:bg-rose-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-divide text-4xl text-rose-600 dark:text-rose-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900 text-rose-700 dark:text-rose-300 rounded-full text-sm font-semibold">
                            +90 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Fracciones Básicas
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Aprende sobre medios, tercios y cuartos
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            15 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Medio
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-rose-500 hover:bg-rose-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>

                 Challenge Card 6: Word Problems 
                <article class="bg-white dark:bg-slate-800 rounded-3xl p-6 border-4 border-teal-200 dark:border-teal-900 hover:border-teal-500 dark:hover:border-teal-400 transition-all shadow-lg hover:shadow-2xl">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-book-open text-4xl text-teal-600 dark:text-teal-400" aria-hidden="true"></i>
                        </div>
                        <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300 rounded-full text-sm font-semibold">
                            +120 XP
                        </span>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                        Problemas del Día
                    </h3>
                    <p class="text-gray-600 dark:text-slate-400 mb-4 leading-relaxed">
                        Resuelve problemas matemáticos cotidianos
                    </p>
                    
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            8 preguntas
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            Difícil
                        </span>
                    </div>
                    
                    <button class="w-full touch-target py-4 bg-teal-500 hover:bg-teal-600 text-white rounded-xl font-bold text-lg transition-all focus-visible-ring">
                        ¡Comenzar Reto!
                    </button>
                </article>
            </div>
        </section>

         Recent Rewards Section 
        <section class="mt-12" aria-labelledby="rewards-heading">
            <h2 id="rewards-heading" class="text-3xl font-bold text-gray-900 dark:text-slate-100 mb-6">
                Recompensas Recientes
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                 Reward Badge 1 
                <div class="bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-star text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Primera Estrella</p>
                </div>
                
                 Reward Badge 2 
                <div class="bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-rocket text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Despegue</p>
                </div>
                
                 Reward Badge 3 
                <div class="bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-brain text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Genio</p>
                </div>
                
                 Reward Badge 4 
                <div class="bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-crown text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Campeón</p>
                </div>
                
                 Reward Badge 5 
                <div class="bg-gradient-to-br from-rose-400 to-red-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-heart text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Perseverante</p>
                </div>
                
                 Reward Badge 6 
                <div class="bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl p-6 text-center shadow-lg">
                    <i class="fas fa-gem text-5xl text-white mb-2" aria-hidden="true"></i>
                    <p class="text-white font-bold text-sm">Diamante</p>
                </div>
            </div>
        </section>
    </main>

 

</div>

   
 

