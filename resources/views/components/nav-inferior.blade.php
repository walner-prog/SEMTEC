<section class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 sm:hidden">
    <div class="flex h-16 justify-around items-center px-4">
      <a href="{{ route('dashboard') }}"
        class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
        <i class="fa-solid fa-gauge text-2xl"></i>
        <span class="text-xs mt-1">Panel</span>
    </a>

    <a href="{{ route('juegos.index') }}"
        class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 transition-colors duration-200">
        <i class="fa-solid fa-puzzle-piece text-2xl"></i>
        <span class="text-xs mt-1">Juegos</span>
    </a>


    <a href="{{ route('ia') }}"
        class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-200">
        <i class="fa-solid fa-robot text-2xl"></i>
        <span class="text-xs mt-1">IA</span>
    </a>

        <a href="{{ route('mision') }}"
        class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200">
        <i class="fa-solid fa-bullseye text-2xl"></i>
        <span class="text-xs mt-1">Misión</span>
    </a>

    


    
        
    </div>
</section>

<div class="h-16 w-full sm:hidden"></div>