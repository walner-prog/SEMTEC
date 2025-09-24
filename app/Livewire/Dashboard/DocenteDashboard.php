<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DocenteDashboard extends Component
{
    public $tab = 'panel'; // panel | contenido | seguimiento

    protected $queryString = ['tab']; // Esto sincroniza $tab con la URL

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('livewire.dashboard.docente-dashboard');
    }
}
