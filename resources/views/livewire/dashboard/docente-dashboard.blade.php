<div>
    {{-- Tabs mejorados --}}
 <!-- Navegación Principal -->
<div>
    <!-- 📱 NAV MÓVIL -->
   <div class="sticky top-0 left-0 right-0 z-40 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm 
                flex justify-around items-center py-2 px-1 lg:hidden">
        
        <!-- Panel -->
        <button wire:click="setTab('panel')" 
            class="flex flex-col items-center text-xs transition-all duration-200 
                   {{ $tab === 'panel' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
            <i class="fas fa-chalkboard text-lg"></i>
            <span>Panel</span>
        </button>

        <!-- Contenido -->
        <button wire:click="setTab('contenido')" 
            class="flex flex-col items-center text-xs transition-all duration-200 
                   {{ $tab === 'contenido' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
            <i class="fas fa-book-open text-lg"></i>
            <span>Contenido</span>
        </button>

        <!-- Seguimiento -->
        <button wire:click="setTab('seguimiento')" 
            class="flex flex-col items-center text-xs transition-all duration-200 
                   {{ $tab === 'seguimiento' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
            <i class="fas fa-tasks text-lg"></i>
            <span>Seguimiento</span>
        </button>

        <!-- Revisión -->
        <button wire:click="setTab('revision')" 
            class="flex flex-col items-center text-xs transition-all duration-200 
                   {{ $tab === 'revision' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
            <i class="fas fa-check-circle text-lg"></i>
            <span>Revisar</span>
        </button>

        <!-- Reportes -->
        <button wire:click="setTab('reportes')" 
            class="flex flex-col items-center text-xs transition-all duration-200 
                   {{ $tab === 'reportes' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
            <i class="fas fa-chart-bar text-lg"></i>
            <span>Reportes</span>
        </button>
    </div>

    <!-- 💻 NAV ESCRITORIO -->
    <div class="hidden lg:block overflow-x-auto">
        <div class="flex justify-center space-x-4 border-b dark:border-gray-700 pb-2 flex-nowrap min-w-max 
                    bg-gradient-to-r from-green-100 via-blue-100 to-purple-100 
                    dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-t-xl shadow">
            
            @foreach([
                ['panel', 'fas fa-chalkboard', 'Panel'],
                ['contenido', 'fas fa-book-open', 'Contenido'],
                ['seguimiento', 'fas fa-tasks', 'Seguimiento'],
                ['revision', 'fas fa-check-circle', 'Revisar'],
                ['reportes', 'fas fa-chart-bar', 'Reportes']
            ] as [$key, $icon, $label])
                <button wire:click="setTab('{{ $key }}')" 
                    class="flex items-center gap-2 px-4 py-2 transition-all duration-300 rounded-t-lg 
                           {{ $tab === $key 
                               ? 'border-b-2 border-blue-500 font-bold text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 shadow-md' 
                               : 'text-gray-600 dark:text-gray-300 hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="{{ $icon }}"></i> {{ $label }}
                </button>
            @endforeach
        </div>
    </div>
</div>


    {{-- Contenido dinámico --}}
    <div class="mt-6 bg-white dark:bg-gray-800 p-2 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        @if($tab === 'panel')
            @livewire('docente-panel')
        @elseif($tab === 'contenido')
            @livewire('docente-contenido')
        @elseif($tab === 'seguimiento')
            @livewire('docente-seguimiento')
        @elseif($tab === 'revision')
            @livewire('docente-revision-tareas')
        @elseif($tab === 'reportes')
            @livewire('docente-reportes-desempeno')
        @endif
    </div>
</div>
