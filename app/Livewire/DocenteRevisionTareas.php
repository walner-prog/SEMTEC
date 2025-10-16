<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Intento;
use App\Models\Revision;
use App\Models\Grado;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;

class DocenteRevisionTareas extends Component
{
    use WithPagination;

    public $grado_id = '';
    public $unidad_id = '';
    public $competencia_id = '';
    public $indicador_id = '';
    public $actividad_id = '';
    public $estado = 'pendientes';  

   
    public $intentoSeleccionado;
    public $retroalimentacion = '';
    public $calificacion = '';
    public $mostrarModal = false;

   
    public function getGradosProperty()
    {
        return Auth::user()->grados;
    }

    public function getUnidadesProperty()
    {
        if (!$this->grado_id) return collect();
        return Unidad::where('grado_id', $this->grado_id)->get();
    }

    public function getCompetenciasProperty()
    {
        if (!$this->unidad_id) return collect();
        return Competencia::where('unidad_id', $this->unidad_id)->get();
    }

    public function getIndicadoresProperty()
    {
        if (!$this->competencia_id) return collect();
        return Indicador::where('competencia_id', $this->competencia_id)->get();
    }

    public function getActividadesProperty()
    {
        if (!$this->indicador_id) return collect();
        return Actividad::where('indicador_id', $this->indicador_id)->get();
    }

    
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

 
  
    public function getIntentosQuery()
    {
        $query = Intento::with(['usuario', 'actividad.indicador.competencia.unidad', 'revision'])
            ->whereHas('actividad', function ($query) {
                $query->whereHas('indicador', function ($query) {
                    $query->whereHas('competencia', function ($query) {
                        $query->whereHas('unidad', function ($query) {
                            if ($this->grado_id) $query->where('grado_id', $this->grado_id);
                            if ($this->unidad_id) $query->where('id', $this->unidad_id);
                        });
                        if ($this->competencia_id) $query->where('id', $this->competencia_id);
                    });
                    if ($this->indicador_id) $query->where('id', $this->indicador_id);
                });
                if ($this->actividad_id) $query->where('id', $this->actividad_id);
            });

      
        if ($this->estado === 'pendientes') {
            $query->whereDoesntHave('revision')
                ->orWhereHas('revision', function ($q) {
                    $q->where('revisado', false);
                });
        } elseif ($this->estado === 'revisados') {
            $query->whereHas('revision', function ($q) {
                $q->where('revisado', true);
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

   
    public function abrirModalRevision($intentoId)
    {
        $this->intentoSeleccionado = Intento::with(['usuario', 'actividad', 'revision'])->find($intentoId);
        $this->retroalimentacion = $this->intentoSeleccionado->revision->retroalimentacion ?? '';
        $this->calificacion = $this->intentoSeleccionado->revision->calificacion ?? '';
        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal = false;
        $this->reset(['intentoSeleccionado', 'retroalimentacion', 'calificacion']);
    }

    public function guardarRevision()
    {
        $this->validate([
            'retroalimentacion' => 'required|string|min:10',
            'calificacion' => 'nullable|integer|min:0|max:100'
        ]);

        Revision::updateOrCreate(
            ['intento_id' => $this->intentoSeleccionado->id],
            [
                'docente_id' => Auth::id(),
                'revisado' => true,
                'retroalimentacion' => $this->retroalimentacion,
                'calificacion' => $this->calificacion,
                'fecha_revision' => now()
            ]
        );

        $this->cerrarModal();
        session()->flash('message', 'Revisión guardada correctamente.');
    }

    public function marcarComoRevisado($intentoId)
    {
        Revision::updateOrCreate(
            ['intento_id' => $intentoId],
            [
                'docente_id' => Auth::id(),
                'revisado' => true,
                'fecha_revision' => now()
            ]
        );

        session()->flash('message', 'Tarea marcada como revisada.');
    }

    
    public function render()
    {
        return view('livewire.docente-revision-tareas', [
            'intentos' => $this->intentos,
            'grados' => $this->grados,
            'unidades' => $this->unidades,
            'competencias' => $this->competencias,
            'indicadores' => $this->indicadores,
            'actividades' => $this->actividades,
        ]);
    }
}
