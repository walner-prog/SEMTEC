<div>
    {{-- Tabs para Estudiante Dashboard --}}
    <div class="overflow-x-auto">
        <div class="flex justify-center space-x-6 border-b pb-2 flex-nowrap min-w-max bg-blue-50 dark:bg-gray-800">
            <button wire:click="setTab('panel')" 
                class="px-4 py-2 transition 
                       {{ $tab === 'panel' ? 'border-b-2 border-blue-500 font-bold text-blue-600 dark:text-blue-400' 
                                           : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">
                Panel
            </button>
            <button wire:click="setTab('contenido')" 
                class="px-4 py-2 transition 
                       {{ $tab === 'contenido' ? 'border-b-2 border-blue-500 font-bold text-blue-600 dark:text-blue-400' 
                                               : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">
                Actividades
            </button>

           
            
        </div>
    </div>

    {{-- Renderizar subcomponentes dinámicamente --}}
    <div class="mt-6">
        @if($tab === 'panel')
            @livewire('estudiante-panel')
        @elseif($tab === 'contenido')
            @livewire('estudiante-contenido')
       
        @endif
    </div>
</div>
