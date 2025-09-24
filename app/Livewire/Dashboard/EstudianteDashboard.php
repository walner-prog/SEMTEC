<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class EstudianteDashboard extends Component
{
    public $tab = 'panel'; // panel | contenido | seguimiento

    protected $queryString = ['tab']; // Esto sincroniza $tab con la URL

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('livewire.dashboard.estudiante-dashboard');
    }
}
