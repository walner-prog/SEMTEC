<div>
    
    <div class="overflow-x-auto">
        <div class="flex justify-center space-x-4 border-b dark:border-gray-700 pb-2 flex-nowrap min-w-max 
                    bg-gradient-to-r from-green-100 via-blue-100 to-purple-100 
                    dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-t-xl shadow">
            
            <button wire:click="setTab('panel')" 
                class="flex items-center gap-2 px-4 py-2 transition-all duration-300 rounded-t-lg 
                       {{ $tab === 'panel' 
                           ? 'border-b-2 border-blue-500 font-bold text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 shadow-md' 
                           : 'text-gray-600 dark:text-gray-300 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <i class="fas fa-chalkboard"></i> Panel
            </button>

            

            <button wire:click="setTab('seguimiento')" 
                class="flex items-center gap-2 px-4 py-2 transition-all duration-300 rounded-t-lg 
                       {{ $tab === 'seguimiento' 
                           ? 'border-b-2 border-blue-500 font-bold text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 shadow-md' 
                           : 'text-gray-600 dark:text-gray-300 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <i class="fas fa-tasks"></i> Seguimiento
            </button>

        
 
        </div>
    </div>

    {{-- Contenido dinámico --}}
    <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        @if($tab === 'panel')
            @livewire('tutor-panel')
        @elseif($tab === 'seguimiento')
            @livewire('tutor-seguimiento')

        @endif
    </div>
</div>
