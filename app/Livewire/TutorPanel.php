<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TutorPanel extends Component
{
    public $hijos;
    public $modalAbierto = false;
    public $modalTipo = null; // 'juegos' o 'actividades'
    public $modalHijo = null;
    public $notificaciones = null;

   public function mount()
{
    $user = Auth::user();

    if ($user->hasRole('Tutor')) {
        $this->hijos = $user->hijos()
            ->with([
                'matriculas',
                'intentos.actividad',
                'intentos.revision',
                'juegos.preguntas', // Trae preguntas de cada juego
            ])
            ->get()
            ->map(function ($hijo) {

                // --- Estadísticas Juegos ---
                $totalJuegos = $hijo->juegos->count();
                $completados = $hijo->juegos->where('pivot.completado', true)->count();
                $puntajeTotal = $hijo->juegos->sum('pivot.puntaje');

                $promediosPorJuego = $hijo->juegos->map(function ($juego) {
                    $puntajeObtenido = $juego->pivot->puntaje ?? 0;
                    $totalPreguntas = $juego->preguntas->count();
                    $puntajeMaximo = $totalPreguntas * 2;
                    return $puntajeMaximo > 0 ? ($puntajeObtenido / $puntajeMaximo) * 100 : 0;
                });
                $promedioJuegos = $promediosPorJuego->avg() ?? 0;

                // --- Estadísticas Actividades ---
                $totalActividades = $hijo->intentos->count();
                $completadasActividades = $hijo->intentos->where('puntaje', '>', 0)->count();
                $promedioActividades = $hijo->intentos->avg('puntaje') ?? 0;

                $hijo->estadisticaTutor = [
                    'juegos' => [
                        'total' => $totalJuegos,
                        'completados' => $completados,
                        'puntaje_total' => $puntajeTotal,
                        'promedio' => round($promedioJuegos, 1),
                    ],
                    'actividades' => [
                        'total' => $totalActividades,
                        'completadas' => $completadasActividades,
                        'promedio' => round($promedioActividades, 1),
                    ],
                ];

                return $hijo;
            });
    } else {
        $this->hijos = collect();
    }
}


  public function abrirModal($tipo, $hijoId)
{
    $this->modalTipo = $tipo;
    $hijo = $this->hijos->firstWhere('id', $hijoId);

    // Recalcular estadísticas para Livewire
    $totalJuegos = $hijo->juegos->count();
    $completados = $hijo->juegos->where('pivot.completado', true)->count();
    $puntajeTotal = $hijo->juegos->sum('pivot.puntaje');
    $promediosPorJuego = $hijo->juegos->map(function ($juego) {
        $puntajeObtenido = $juego->pivot->puntaje ?? 0;
        $totalPreguntas = $juego->preguntas->count();
        $puntajeMaximo = $totalPreguntas * 2;
        return $puntajeMaximo > 0 ? ($puntajeObtenido / $puntajeMaximo) * 100 : 0;
    });
    $promedioJuegos = $promediosPorJuego->avg() ?? 0;

    $totalActividades = $hijo->intentos->count();
    $completadasActividades = $hijo->intentos->where('puntaje', '>', 0)->count();
    $promedioActividades = $hijo->intentos->avg('puntaje') ?? 0;

    $hijo->estadisticaTutor = [
        'juegos' => [
            'total' => $totalJuegos,
            'completados' => $completados,
            'puntaje_total' => $puntajeTotal,
            'promedio' => round($promedioJuegos, 1),
        ],
        'actividades' => [
            'total' => $totalActividades,
            'completadas' => $completadasActividades,
            'promedio' => round($promedioActividades, 1),
        ],
    ];

    $this->modalHijo = $hijo;
    $this->modalAbierto = true;
}

    public function cerrarModal()
    {

        
        $this->modalAbierto = false;
        $this->modalTipo = null;
        $this->modalHijo = null;
        $this->mount(); // Re-cargar datos
    }

    public function render()
    {
        return view('livewire.tutor-panel');
    }
}
