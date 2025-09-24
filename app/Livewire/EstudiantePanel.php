<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Actividad;

class EstudiantePanel extends Component
{
    public $grado;
    public $actividades = [];

    public function mount()
    {
        $user = Auth::user();

        // 🔹 Obtener el primer grado del estudiante
        $this->grado = $user->grados()->with(['unidades.competencias.indicadores.actividades'])->first();

        if (!$this->grado) return;

        // 🔹 Obtener IDs de actividades ya completadas
        $intentosIds = $user->intentos()->pluck('actividad_id')->toArray();

        // 🔹 Mapear todas las actividades con estado
        $this->actividades = $this->grado->unidades->flatMap(function ($unidad) use ($intentosIds) {
            return $unidad->competencias->flatMap(function ($comp) use ($intentosIds) {
                return $comp->indicadores->flatMap(function ($ind) use ($intentosIds) {
                    return $ind->actividades->map(function ($act) use ($intentosIds) {
                        $act->estado = in_array($act->id, $intentosIds) ? 'completada' : 'pendiente';
                        return $act;
                    });
                });
            });
        });
    }

    public function render()
    {
        // Separar actividades
        $actividadesPendientes = $this->actividades->where('estado', 'pendiente');
        $actividadesCompletadas = $this->actividades->where('estado', 'completada');

        return view('livewire.estudiante-panel', [
            'grado' => $this->grado,
            'actividadesPendientes' => $actividadesPendientes,
            'actividadesCompletadas' => $actividadesCompletadas,
        ]);
    }
}
