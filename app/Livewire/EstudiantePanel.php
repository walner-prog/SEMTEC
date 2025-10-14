<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Actividad;
use App\Models\Recompensa;
use Illuminate\Support\Collection;

class EstudiantePanel extends Component
{
    public $grado;
    public $actividades; // Collection
    public $actividadesPendientes;
    public $actividadesCompletadas;
    public $porcentajeProgreso = 0;
    public $xp;
    public $recompensasDisponibles = [];
    public $modoAccesible = false;
    public $pistaIA;
    public $retos = [];




    protected $listeners = [
        'actividadCompletada' => 'handleActividadCompletada',
    ];

    public function mount()
    {
        $user = Auth::user();

        // Cargar grado + relaciones (como antes)
        $this->grado = $user->grados()->with(['unidades.competencias.indicadores.actividades'])->first();

        if (!$this->grado) {
            $this->actividades = collect();
            $this->actividadesPendientes = collect();
            $this->actividadesCompletadas = collect();
            $this->xp = $user->xp ?? 0;
            $this->recompensasDisponibles = Recompensa::orderBy('puntos_requeridos')->get();
            $this->modoAccesible = session()->get('modo_accesible', false);
            return;
        }

        // IDs de actividades ya completadas por el usuario
        $intentosIds = $user->intentos()->pluck('actividad_id')->toArray();

        // Mapear actividades con estado
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

        $this->separarActividades();
        $this->xp = $user->xp ?? 0;
        $this->recompensasDisponibles = Recompensa::orderBy('puntos_requeridos')->get();
        $this->modoAccesible = session()->get('modo_accesible', false);
        $this->calcularRetos();
    }

    private function separarActividades()
    {
        $this->actividades = collect($this->actividades);
        $this->actividadesPendientes = $this->actividades->where('estado', 'pendiente')->values();
        $this->actividadesCompletadas = $this->actividades->where('estado', 'completada')->values();
        $this->calcularProgreso();
    }

    private function calcularProgreso()
    {
        $total = $this->actividades->count();
        $completadas = $this->actividadesCompletadas->count();
        $this->porcentajeProgreso = $total === 0 ? 0 : round(($completadas / $total) * 100, 0);
    }

    public function toggleAccesibilidad()
    {
        $this->modoAccesible = ! session()->get('modo_accesible', false);
        session()->put('modo_accesible', $this->modoAccesible);
        $this->dispatchBrowserEvent('accesibilidad-cambiada', ['modo' => $this->modoAccesible]);
    }

    /**
     * Simular asignación de una pista "IA" simple (sin llamadas externas)
     * - Genera una pista corta basada en el título/enunciado de la actividad.
     */
    public function generarPista($actividadId = null)
    {
        $actividad = $this->actividades->firstWhere('id', $actividadId) ?? $this->actividadesPendientes->first();
        if (!$actividad) {
            $this->pistaIA = "No hay actividad seleccionada para generar pista.";
            return;
        }

        // heurística simple para crear pista
        $texto = $actividad->titulo ?? ($actividad->enunciado ?? 'Actividad');
        $palabras = explode(' ', strip_tags($texto));
        $primera = $palabras[0] ?? $texto;
        $this->pistaIA = "Pista: Observa atentamente \"{$primera}\" y piensa en pasos pequeños para resolverlo. Si es cálculo, descompón el número en partes.";
    }

    /**
     * Cuando una actividad se completa (evento emitido desde la vista/otro componente)
     */
    public function handleActividadCompletada($actividadId, $xpGanada = 10)
    {
        $user = Auth::user();

        // marcar localmente
        $idx = $this->actividades->search(fn($a) => $a->id == $actividadId);
        if ($idx !== false) {
            $this->actividades[$idx]->estado = 'completada';
            $this->separarActividades();
        }

        // otorgar XP al usuario y guardar
        $user->increment('xp', $xpGanada);
        $this->xp = $user->xp;

        // intentar asignar recompensas que cumpla con el XP
        $this->autoAsignarRecompensas($user);
    }

    /**
     * Asigna automáticamente recompensas que el usuario califica y no tenga aún.
     */
    private function autoAsignarRecompensas($user)
    {
        $disponibles = Recompensa::where('puntos_requeridos', '<=', $user->xp)->get();
        foreach ($disponibles as $r) {
            $ya = $user->recompensas()->where('recompensa_id', $r->id)->exists();
            if (! $ya) {
                $user->recompensas()->attach($r->id, ['fecha' => now()]);
                // opcional: emitir evento para notificar UI
                $this->dispatchBrowserEvent('recompensa-obtenida', [
                    'clave' => $r->clave,
                    'nombre' => $r->tipo,
                    'icono' => $r->icono_url
                ]);
            }
        }
    }

    /**
     * Método manual para reclamar/activar una recompensa desde la UI
     */
    public function reclamarRecompensa($recompensaId)
    {
        $user = Auth::user();
        $r = Recompensa::find($recompensaId);
        if (! $r) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => 'Recompensa no encontrada.']);
            return;
        }

        if ($user->recompensas()->where('recompensa_id', $r->id)->exists()) {
            $this->dispatchBrowserEvent('toast', ['type' => 'info', 'message' => 'Ya tienes esta recompensa.']);
            return;
        }

        if ($user->xp < $r->puntos_requeridos) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => 'No tienes suficientes puntos XP.']);
            return;
        }

        $user->recompensas()->attach($r->id, ['fecha' => now()]);
        $this->dispatchBrowserEvent('toast', ['type' => 'success', 'message' => "Recompensa '{$r->tipo}' agregada."]);
        $this->recompensasDisponibles = Recompensa::orderBy('puntos_requeridos')->get();
    }



    private function calcularRetos()
{
    $user = Auth::user();

    $totalSemana = $user->intentos()
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->count();

    $matematicas = $user->intentos()
        ->whereHas('actividad', fn($q) => $q->where('tipo', 'matematica'))
        ->count();

 

    $this->retos = [
        [
            'titulo' => 'Completar 5 actividades esta semana',
            'icono' => 'fa-bolt text-red-500',
            'fondo' => 'bg-red-50 dark:bg-gray-700',
            'progreso' => $totalSemana,
            'meta' => 5,
        ],
        [
            'titulo' => 'Resolver 3 retos matemáticos',
            'icono' => 'fa-brain text-purple-500',
            'fondo' => 'bg-purple-50 dark:bg-gray-700',
            'progreso' => $matematicas,
            'meta' => 3,
        ],
         
    ];
}

    public function render()
    {
        return view('livewire.estudiante-panel', [
            'grado' => $this->grado,
            'actividadesPendientes' => $this->actividadesPendientes,
            'actividadesCompletadas' => $this->actividadesCompletadas,
            'porcentajeProgreso' => $this->porcentajeProgreso,
            'xp' => $this->xp,
            'recompensas' => $this->recompensasDisponibles,
            'modoAccesible' => $this->modoAccesible,
            'pistaIA' => $this->pistaIA,
        ]);
    }
}
