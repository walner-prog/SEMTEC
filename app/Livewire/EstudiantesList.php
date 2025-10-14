<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Matricula;
use App\Models\Escuela;
use App\Models\Grado;

class EstudiantesList extends Component
{
    use WithPagination;

    public $search = '';
    public $escuelaFilter = null;
    public $gradoFilter = null;
    public $anioFilter = null;
    public $perPage = 200;

    public $perPageOptions = [200, 300, 400, 500];

    protected $paginationTheme = 'tailwind';

    // Reset paginación al cambiar filtros
    public function updating($field)
    {
        if (in_array($field, ['search', 'escuelaFilter', 'gradoFilter', 'anioFilter'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $matriculasQuery = Matricula::query()
            ->with(['estudiante', 'escuela', 'docente'])
            ->when($this->search, fn($q) =>
                $q->whereHas('estudiante', fn($q2) =>
                    $q2->where('name', 'like', "%{$this->search}%")
                )
            )
            ->when($this->escuelaFilter, fn($q) =>
                $q->where('escuela_id', $this->escuelaFilter)
            )
            ->when($this->gradoFilter, fn($q) =>
                $q->where('grado', $this->gradoFilter)
            )
            ->when($this->anioFilter, fn($q) =>
                $q->where('anio', $this->anioFilter)
            )
            ->orderBy('fecha_matricula', 'desc');

        $matriculas = $matriculasQuery->paginate($this->perPage);

        $escuelas = Escuela::orderBy('nombre')->get();
        $grados = Grado::orderBy('nombre')->get();

        // Obtener lista de años disponibles en la tabla
        $anios = Matricula::select('anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('livewire.estudiantes-list', compact('matriculas', 'escuelas', 'grados', 'anios'));
    }
}
