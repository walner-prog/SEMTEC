<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Matricula;
use App\Models\Intento;

class DocentePanel extends Component
{
    use WithPagination;

    public $filtroEstudiante = '';
    public $filtroGrado = '';
    protected $paginationTheme = 'tailwind';
    public $perPage = 3;

    public function updatingFiltroEstudiante() { $this->resetPage(); }
    public function updatingFiltroGrado() { $this->resetPage(); }

    public function render()
    {
        $docenteId = Auth::id();

        // Traer matrículas ya paginadas directamente
        $matriculas = Matricula::with('estudiante')
            ->where('docente_id', $docenteId)
            ->when($this->filtroGrado, fn($q) => $q->where('grado', $this->filtroGrado))
            ->when($this->filtroEstudiante, fn($q) => 
                $q->whereHas('estudiante', fn($q2) => 
                    $q2->where('name', 'like', '%' . $this->filtroEstudiante . '%')
                )
            )
            ->paginate($this->perPage);

        // Construir resumen para mostrar en tabla
        $resumen = $matriculas->map(function($matricula){
            $estudiante = $matricula->estudiante;

            $intentos = Intento::with('actividad.indicador.competencia')
                ->where('user_id', $estudiante->id)
                ->get();

            $porCompetencia = $intentos->groupBy(fn($i) => $i->actividad->indicador->competencia->id ?? 'sin_id')
                ->map(fn($items) => [
                    'competencia' => $items->first()->actividad->indicador->competencia->titulo ?? '-',
                    'total_actividades' => $items->first()->actividad->indicador->competencia
                                                ->indicadores
                                                ->flatMap->actividades
                                                ->unique('id')
                                                ->count(),
                    'puntaje_promedio' => round($items->avg('puntaje'), 2),
                ]);

            // Si no hay competencias con intentos, agregar fila vacía
            if ($porCompetencia->isEmpty()) {
                return (object)[
                    'estudiante' => $estudiante->name,
                    'grado'      => $matricula->grado,
                    'competencia'=> '-',
                    'total_actividades'=> 0,
                    'puntaje_promedio'=> 0,
                ];
            } else {
                return collect($porCompetencia)->map(fn($c) => (object)[
                    'estudiante' => $estudiante->name,
                    'grado'      => $matricula->grado,
                    'competencia'=> $c['competencia'],
                    'total_actividades'=> $c['total_actividades'],
                    'puntaje_promedio'=> $c['puntaje_promedio'],
                ])->all();
            }
        })->flatten();

        // Lista de grados para filtro
        $grados = Matricula::where('docente_id', $docenteId)->pluck('grado')->unique()->sort()->values();

        return view('livewire.docente-panel', [
            'resumenDesempeno' => $resumen,
            'grados' => $grados,
            'matriculas' => $matriculas,
        ]);
    }
}
