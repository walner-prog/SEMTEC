<x-app-layout>


    <div
        class=" from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen flex flex-col">
        

        <main class="p-2 flex-1 space-y-6">

            @role('Docente')
            @livewire('dashboard.docente-dashboard')
            @endrole


            @role('Estudiante')
            @livewire('dashboard.estudiante-dashboard')
            @endrole


            @role('Tutor')
            @livewire('dashboard.tutor-dashboard')
            @endrole


            @role('Administrador')
            @livewire('dashboard.administrador-dashboard')
            @endrole


        </main>



    </div>


</x-app-layout>