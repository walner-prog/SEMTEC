<x-app-layout>


    <div
        class=" from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen flex flex-col">





        <main class="p-6 flex-1 space-y-6">





            <main class="p-6 flex-1 space-y-6">

                {{-- 📚 DOCENTE --}}
                @role('Docente')
                @livewire('dashboard.docente-dashboard')
                @endrole

                {{-- 🎓 ESTUDIANTE --}}
                @role('Estudiante')
                @livewire('dashboard.estudiante-dashboard')
                @endrole

                {{-- 👨‍👩‍👧 TUTOR --}}
                @role('Tutor')
                @livewire('dashboard.tutor-dashboard')
                @endrole








                </section>


            </main>



    </div>


</x-app-layout>