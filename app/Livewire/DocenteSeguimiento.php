<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividad;
use App\Models\Intento;
use App\Models\Grado;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use Illuminate\Support\Facades\Auth;

class DocenteSeguimiento extends Component
{
    use WithPagination;

    public $grado_id = '';
    public $unidad_id = '';
    public $competencia_id = '';
    public $indicador_id = '';
    public $actividad_id = '';

    // -----------------------------
    // Propiedades computadas
    // -----------------------------
    public function getGradosProperty()
    {
        return Grado::whereHas('docentes', function($q) {
            $q->where('user_id', Auth::id());
        })->get();
    }

    public function getUnidadesProperty()
    {
        if (!$this->grado_id) {
            return collect();
        }
        return Unidad::where('grado_id', $this->grado_id)->get();
    }

    public function getCompetenciasProperty()
    {
        if (!$this->unidad_id) {
            return collect();
        }
        return Competencia::where('unidad_id', $this->unidad_id)->get();
    }

    public function getIndicadoresProperty()
    {
        if (!$this->competencia_id) {
            return collect();
        }
        return Indicador::where('competencia_id', $this->competencia_id)->get();
    }

    public function getActividadesProperty()
    {
        if (!$this->indicador_id) {
            return collect();
        }
        return Actividad::where('indicador_id', $this->indicador_id)->get();
    }

    // -----------------------------
    // Resets en cascada
    // -----------------------------
    public function updatedGradoId()
    {
        $this->reset(['unidad_id', 'competencia_id', 'indicador_id', 'actividad_id']);
    }

    public function updatedUnidadId()
    {
        $this->reset(['competencia_id', 'indicador_id', 'actividad_id']);
    }

    public function updatedCompetenciaId()
    {
        $this->reset(['indicador_id', 'actividad_id']);
    }

    public function updatedIndicadorId()
    {
        $this->reset(['actividad_id']);
    }

    // -----------------------------
    // Query principal
    // -----------------------------
    public function getIntentosQuery()
    {
        $query = Intento::with(['usuario', 'actividad.indicador.competencia.unidad']);

        if ($this->grado_id) {
            $query->whereHas('actividad.indicador.competencia.unidad', function($q) {
                $q->where('grado_id', $this->grado_id);
            });
        }

        if ($this->unidad_id) {
            $query->whereHas('actividad.indicador.competencia.unidad', function($q) {
                $q->where('id', $this->unidad_id);
            });
        }

        if ($this->competencia_id) {
            $query->whereHas('actividad.indicador.competencia', function($q) {
                $q->where('id', $this->competencia_id);
            });
        }

        if ($this->indicador_id) {
            $query->whereHas('actividad.indicador', function($q) {
                $q->where('id', $this->indicador_id);
            });
        }

        if ($this->actividad_id) {
            $query->whereHas('actividad', function($q) {
                $q->where('id', $this->actividad_id);
            });
        }

        return $query;
    }

    public function getIntentosProperty()
    {
        return $this->getIntentosQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(300);
    }

    // -----------------------------
    // Render
    // -----------------------------
    public function render()
    {
        return view('livewire.docente-seguimiento', [
            'intentos' => $this->intentos,
            'grados' => $this->grados,
            'unidades' => $this->unidades,
            'competencias' => $this->competencias,
            'indicadores' => $this->indicadores,
            'actividades' => $this->actividades,
        ]);
    }
}
