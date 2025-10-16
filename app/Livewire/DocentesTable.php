<?php

namespace App\Livewire;

 

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Matricula;

class DocentesTable extends Component
{
    use WithPagination;

    public $perPage = 200;  
    public $showStudents = null;  
    public $students = [];

    protected $paginationTheme = 'tailwind';

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function verDetalle($docenteId)
    {
        $this->students = User::whereHas('matriculas', function($q) use ($docenteId) {
            $q->where('docente_id', $docenteId);
        })->role('Estudiante')->get();

        $this->showStudents = $docenteId;
    }

    public function cerrarDetalle()
    {
        $this->showStudents = null;
        $this->students = [];
    }

    public function render()
    {
        $docentes = User::role('Docente')->paginate($this->perPage);

        return view('livewire.docentes-table', [
            'docentes' => $docentes,
        ]);
    }
}
