<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/logo.png') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    <script>
        (function() {
            const html = document.documentElement;
            const theme = localStorage.getItem('theme');

            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="bg-[#FDFDFC] ">
  <div class="min-h-screen dark:border-gray-700 pb-2 flex-nowrap w-full
            bg-gradient-to-r from-green-100 via-blue-100 to-purple-100 
            dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-t-xl shadow">

    <livewire:navigation />

    <main class="flex-grow">

        {{-- HERO PRINCIPAL --}}
        <section class="bg-gradient-to-r from-[#164b99] to-[#439f46] text-white py-20">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fadeInDown">SEMTEC</h1>
                <p class="text-lg md:text-2xl mb-6 font-light animate-fadeIn delay-150">Plataforma educativa inclusiva para matemáticas</p>
                <p class="max-w-3xl mx-auto mb-8 text-base md:text-lg animate-fadeIn delay-300">
                    Democratizamos el aprendizaje de las matemáticas en primaria con accesibilidad,
                    gamificación e inteligencia artificial.
                </p>
                <a href="{{ route('login') }}"
                   class="bg-white text-[#164b99] px-8 py-3 rounded-full shadow-lg text-lg font-semibold 
                          hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 transition 
                          animate-bounce">
                    Comenzar ahora
                </a>
            </div>
        </section>

        {{-- CARACTERÍSTICAS DISRUPTIVAS --}}
        <section class="py-16 bg-[#FDFDFC] dark:bg-[#0a0a0a] transition-colors">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 text-[#164b99] dark:text-[#4da6ff] animate-fadeInUp">Características disruptivas</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    @foreach([
                        ['icon'=>'fa-gamepad','color'=>'#439f46','title'=>'Juegos interactivos','text'=>'Actividades gamificadas alineadas al currículo nacional.'],
                        ['icon'=>'fa-brain','color'=>'#164b99','title'=>'IA Adaptativa','text'=>'Personaliza las actividades según el progreso del estudiante.'],
                        ['icon'=>'fa-trophy','color'=>'#FFD700','title'=>'Gamificación','text'=>'Puntos, monedas y logros que refuerzan la motivación.'],
                        ['icon'=>'fa-chalkboard-user','color'=>'#439f46','title'=>'Asistente Pedagógico','text'=>'Recomendaciones inclusivas y reportes inteligentes para docentes.']
                    ] as $card)
                    <div class="p-6 bg-white dark:bg-gray-900 dark:text-gray-100 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 animate-fadeInUp">
                        <i class="fa-solid {{ $card['icon'] }} text-5xl" style="color:{{ $card['color'] }};" class="drop-shadow-md mb-4"></i>
                        <h3 class="font-bold text-xl mb-2">{{ $card['title'] }}</h3>
                        <p>{{ $card['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- NECESIDAD DE LA SOLUCIÓN --}}
        <section class="py-16 bg-gradient-to-r from-[#439f46] to-[#164b99] text-white">
            <div class="container mx-auto px-6 text-center animate-fadeIn">
                <h2 class="text-3xl font-bold mb-6">Necesidad de la solución</h2>
                <p class="max-w-4xl mx-auto text-lg opacity-90">
                    Aunque el Gobierno de Nicaragua impulsa la educación inclusiva, muchos estudiantes con
                    discapacidad auditiva o visual aún enfrentan barreras en matemáticas. SEMTEC responde a esa necesidad con accesibilidad, IA y gamificación.
                </p>
            </div>
        </section>

        {{-- PROBLEMAS QUE RESUELVE --}}
        <section class="py-16 bg-[#FDFDFC] dark:bg-[#0a0a0a] transition-colors">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-[#164b99] dark:text-[#4da6ff] mb-12 animate-fadeInUp">Problemas que resuelve</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['icon'=>'fa-universal-access','color'=>'#439f46','title'=>'Acceso inclusivo','text'=>'Audio-descripciones, subtítulos y videos en lengua de señas.'],
                        ['icon'=>'fa-sliders','color'=>'#164b99','title'=>'Personalización','text'=>'IA que adapta actividades y retroalimentación según el progreso.'],
                        ['icon'=>'fa-star','color'=>'#FFD700','title'=>'Motivación','text'=>'Gamificación con puntos, logros y recompensas.'],
                        ['icon'=>'fa-person-chalkboard','color'=>'#439f46','title'=>'Apoyo docente','text'=>'Reportes inteligentes y estrategias pedagógicas inclusivas.'],
                        ['icon'=>'fa-people-roof','color'=>'#164b99','title'=>'Tutores activos','text'=>'Seguimiento del progreso y comunicación escuela-familia.'],
                    ] as $card)
                    <div class="p-6 bg-white dark:bg-gray-900 dark:text-gray-100 rounded-xl shadow hover:shadow-xl transition transform hover:scale-105 animate-fadeIn delay-{{$loop->index * 100}}">
                        <i class="fa-solid {{ $card['icon'] }} text-4xl" style="color:{{ $card['color'] }};"></i>
                        <h3 class="font-semibold text-lg mb-2">{{ $card['title'] }}</h3>
                        <p>{{ $card['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ROLES DE USUARIO --}}
        <section class="py-16 bg-gradient-to-r from-[#164b99] to-[#439f46] text-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 animate-fadeInUp">Roles de Usuario</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    @foreach([
                        ['icon'=>'fa-user-shield','title'=>'Administrador'],
                        ['icon'=>'fa-user-graduate','title'=>'Docente'],
                        ['icon'=>'fa-child','title'=>'Estudiante'],
                        ['icon'=>'fa-user-group','title'=>'Tutor'],
                    ] as $role)
                    <div class="hover:scale-110 transition transform animate-bounceIn delay-{{$loop->index*150}}">
                        <i class="fa-solid {{ $role['icon'] }} text-5xl mb-4 drop-shadow"></i>
                        <p class="font-semibold">{{ $role['title'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FUTURAS IMPLEMENTACIONES --}}
        <section class="py-16 bg-[#FDFDFC] dark:bg-[#0a0a0a] transition-colors">
            <div class="container mx-auto px-6 text-center animate-fadeInUp">
                <h2 class="text-3xl font-bold text-[#164b99] dark:text-[#4da6ff] mb-6">Futuras implementaciones</h2>
                <p class="max-w-3xl mx-auto mb-8 dark:text-gray-200">
                    SEMTEC seguirá evolucionando con retos multijugador, aplicación móvil,
                    acceso offline y más integración inclusiva.
                </p>
                <i class="fa-solid fa-rocket text-6xl text-[#439f46] dark:text-green-400 animate-bounce drop-shadow-lg"></i>
            </div>
        </section>

    </main>

    <x-nav-inferior />
    <x-footer />
</div>


    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        (function() {
            const html = document.documentElement;
            const toggles = [
                document.getElementById('dark-mode-toggle'),
                document.getElementById('dark-mode-toggle-mobile')
            ];

            function setIcon(btn) {
                if (html.classList.contains('dark')) {
                    btn.textContent = '🌙';
                } else {
                    btn.textContent = '☀️';
                }
            }

            toggles.forEach(btn => {
                if (!btn) return;
                setIcon(btn);
                btn.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
                    toggles.forEach(setIcon);
                });
            });
        })();
    </script>
</body>

</html>