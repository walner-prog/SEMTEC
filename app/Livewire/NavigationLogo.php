<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Configuracion;

class NavigationLogo extends Component
{
    public $config;
    public $size; // Para controlar el tamaño desde el exterior

    public function mount($size = 'h-48 w-auto') // tamaño por defecto
    {
        $this->config = Configuracion::firstOrCreate(
            ['id' => 1],
            ['nombre_sistema' => 'SENTEC', 'logo' => null]
        );

        $this->size = $size;
    }

    public function render()
    {
        return view('livewire.navigation-logo');
    }
}
