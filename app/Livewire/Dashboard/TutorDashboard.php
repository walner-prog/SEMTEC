<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class TutorDashboard extends Component
{

     public $tab = 'panel'; 

    protected $queryString = ['tab']; 

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    
    public function render()
    {
        return view('livewire.dashboard.tutor-dashboard');
    }
}
