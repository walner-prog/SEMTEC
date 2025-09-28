<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class AdministradorDashboard extends Component
{

      public $tab = 'panel'; 

    protected $queryString = ['tab']; 

    public function setTab($tab)
    {
        $this->tab = $tab;
    }
    public function render()
    {
        return view('livewire.dashboard.administrador-dashboard');
    }
}
