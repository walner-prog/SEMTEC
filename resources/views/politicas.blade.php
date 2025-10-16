<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Políticas de Privacidad</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/logo-icon.png') }}">
</head>

<body>

    <x-app-layout>


        <div class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">


            <div
                class="min-h-screen bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-10 px-4 sm:px-6 lg:px-20">
                <div class="max-w-5xl mx-auto">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 text-center">
                        Políticas de Privacidad de SEMTEC
                    </h1>

                    <p class="text-gray-700 dark:text-gray-300 mb-6 text-lg text-justify">
                        SEMTEC se compromete a proteger la privacidad de sus usuarios y garantizar un uso seguro de los
                        datos personales en nuestra plataforma educativa inclusiva para matemáticas. Esta política está
                        alineada con las normativas del Ministerio de Educación (MINED) de Nicaragua y busca promover
                        una educación inclusiva, moderna y accesible para todos.
                    </p>

                    {{-- Sección: Datos recopilados --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">1. Datos recopilados
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                            <li><strong>Estudiantes:</strong> nombre, grado, progreso académico, logros y participación
                                en juegos y actividades.</li>
                            <li><strong>Docentes y tutores:</strong> nombre, correo electrónico, reportes de seguimiento
                                y estrategias pedagógicas utilizadas.</li>
                            <li><strong>Uso de la plataforma:</strong> actividad en juegos, logros, puntuaciones, tiempo
                                de uso, interacción con contenidos y recursos accesibles.</li>
                        </ul>
                    </div>

                    {{-- Sección: Uso de los datos --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">2. Uso de los datos
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                            <li>Personalizar la experiencia de aprendizaje mediante inteligencia artificial adaptativa.
                            </li>
                            <li>Generar reportes y sugerencias pedagógicas alineadas al currículo nacional para docentes
                                y tutores.</li>
                            <li>Mejorar la plataforma y su contenido educativo continuamente.</li>
                            <li>Monitorear la participación y el progreso de los estudiantes para fortalecer la
                                inclusión educativa.</li>
                            <li>Facilitar la adopción institucional de SEMTEC por centros educativos, ofreciendo
                                métricas y reportes que apoyen la toma de decisiones de directores y administradores.
                            </li>
                        </ul>
                    </div>

                    {{-- Sección: Protección de la información --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">3. Protección de la
                            información</h2>
                        <p class="text-gray-700 dark:text-gray-300">
                            SEMTEC aplica medidas de seguridad técnicas, administrativas y organizativas para proteger
                            los datos frente a accesos no autorizados, pérdidas, filtraciones o usos indebidos. Todos
                            los datos se almacenan en servidores seguros con protocolos actualizados de cifrado y
                            autenticación.
                        </p>
                    </div>

                    {{-- Sección: Compartir datos --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">4. Compartir datos</h2>
                        <p class="text-gray-700 dark:text-gray-300">
                            Los datos recopilados solo se compartirán con personal autorizado del MINED o con
                            instituciones educativas que implementen SEMTEC, siempre con fines educativos y alineados a
                            la política nacional de inclusión. Esto permite que los centros educativos monitoreen el
                            progreso de sus estudiantes y mejoren sus estrategias pedagógicas.
                        </p>
                    </div>

                    {{-- Sección: Derechos de los usuarios --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">5. Derechos de los
                            usuarios</h2>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                            <li>Acceder a sus datos personales y actividad dentro de la plataforma.</li>
                            <li>Solicitar corrección de información incorrecta.</li>
                            <li>Solicitar la eliminación de sus datos personales cuando lo consideren necesario.</li>
                            <li>Contactar al equipo de SEMTEC para cualquier consulta o inquietud sobre privacidad.</li>
                        </ul>
                    </div>

                    {{-- Sección: Contacto --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6 text-center">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-3">6. Contacto</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            Para consultas o solicitudes relacionadas con la privacidad y protección de datos, puede
                            escribir a:
                        </p>
                        <a href="mailto:soporte@semtec.edu.ni"
                            class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">soporte@semtec.edu.ni</a>
                    </div>

                    <p class="text-center text-gray-600 dark:text-gray-400 text-sm mt-6">
                        Estas políticas están alineadas con la estrategia nacional “Bendiciones y Victorias” y buscan
                        garantizar que todos los estudiantes, docentes y centros educativos en Nicaragua tengan acceso a
                        una educación inclusiva, innovadora y accesible.
                    </p>
                </div>
            </div>


        </div>
        </div>
    </x-app-layout>

</body>

</html>