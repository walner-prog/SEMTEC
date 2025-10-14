<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Matricula;
use App\Models\Intento;
use App\Models\User;

class DocentePanel extends Component
{
    use WithPagination;

    public $filtroEstudiante = '';
    public $filtroGrado = '';

    protected $paginationTheme = 'tailwind';
    public $perPage = 100;

    public $telefonoTutor = '';
    public $isModalTutorOpen = false;
    public $mensajeTutor = '';
    public $modalNotificaciones = false;
    public $notificaciones = [];
    public $respuesta = '';
    public $notificacionSeleccionada = null;
    public $toasts = []; 


    public function updatingFiltroEstudiante()
    {
        $this->resetPage();
    }
    public function updatingFiltroGrado()
    {
        $this->resetPage();
    }


    // Abrir modal y cargar notificaciones
public function abrirModalNotificaciones()
{
    $this->notificaciones = auth()->user()
        ->notifications()
        ->orderBy('read_at', 'asc')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($n) {
            $titulo = $n->data['titulo'] ?? 'Sin título';
            $mensaje = $n->data['mensaje'] ?? '';
            $color = $n->data['color'] ?? 'text-blue-500';
            $tutorId = $n->data['tutor_id'] ?? null; // Se obtiene directo de los datos

            return (object)[
                'id' => $n->id,
                'read_at' => $n->read_at,
                'titulo' => is_array($titulo) ? implode(' ', $titulo) : $titulo,
                'mensaje' => is_array($mensaje) ? implode(' ', $mensaje) : $mensaje,
                'color' => $color,
                'tutor_id' => $tutorId,
                'created_at' => $n->created_at,
            ];
        });

    $this->modalNotificaciones = true;
}


    // Cerrar modal
    public function cerrarModalNotificaciones()
    {
        $this->modalNotificaciones = false;
        $this->respuesta = '';
        $this->notificacionSeleccionada = null;
    }

    // Marcar una notificación como leída
    public function marcarLeida($id)
    {
        $notificacion = auth()->user()->notifications()->find($id);
        if ($notificacion) {
            $notificacion->markAsRead();
            $this->abrirModalNotificaciones(); // refresca la lista
        }
    }

    // Seleccionar notificación para responder
    public function seleccionarNotificacion($id)
    {
        $this->notificacionSeleccionada = auth()->user()->notifications()->find($id);
    }

    // Enviar respuesta al tutor
public function responderTutor()
{
    if (!$this->notificacionSeleccionada) {
        session()->flash('error', 'No se ha seleccionado ninguna notificación.');
        return;
    }

    $tutorId = $this->notificacionSeleccionada->tutor_id;
    $estudiante = $this->notificacionSeleccionada->titulo ?? 'el estudiante';

    if (!$tutorId) {
        session()->flash('error', 'El tutor asociado a esta notificación no existe.');
        return;
    }

    $tutor = User::find($tutorId);

    if (!$tutor) {
        session()->flash('error', 'No se pudo encontrar al tutor en la base de datos.');
        return;
    }

    if (!$this->respuesta || trim($this->respuesta) === '') {
        session()->flash('error', 'Debe escribir una respuesta antes de enviar.');
        return;
    }

    try {
        $mensaje = "El docente " . auth()->user()->name . " respondió sobre {$estudiante}: {$this->respuesta}";

        $tutor->notify(new \App\Notifications\NotificacionDocenteTutor(
            $mensaje,
            $this->notificacionSeleccionada->id
        ));

        $this->respuesta = '';
        $this->marcarLeida($this->notificacionSeleccionada->id);

        // Activar toast individual
        $this->toasts[$this->notificacionSeleccionada->id] = true;

        session()->flash('success', 'Respuesta enviada correctamente.');
    } catch (\Exception $e) {
        session()->flash('error', 'Ocurrió un error al enviar la respuesta: ' . $e->getMessage());
    }
}






    // Abrir modal con datos del tutor
    public function abrirModalTutor($tutorId)
    {
        //$tutorId = intval($tutorId);

        $tutor = \App\Models\User::find($tutorId);

        if (!$tutor || !$tutor->telefono) {
            session()->flash('error', 'El tutor no tiene un número de teléfono registrado.');
            return;
        }

        $tutorId = intval($tutorId);
        $this->telefonoTutor = $tutor->telefono;
        $this->mensajeTutor = "Hola, soy el docente de su hijo. Quería notificarle sobre el desempeño en clase."; // plantilla
        $this->isModalTutorOpen = true;
    }


    public function cerrarModalTutor()
    {
        $this->telefonoTutor = '';
        $this->mensajeTutor = '';
        $this->isModalTutorOpen = false;
    }

    public function enviarWhatsApp()
    {
        $telefono = preg_replace('/\D/', '', $this->telefonoTutor);
        $mensaje = urlencode($this->mensajeTutor);
        $url = "https://wa.me/{$telefono}?text={$mensaje}";

        $this->cerrarModalTutor();

        return redirect()->away($url);
    }

    public function render()
    {
        $docenteId = Auth::id();

        $matriculasQuery = Matricula::with('estudiante')
            ->where('docente_id', $docenteId)
            ->when($this->filtroGrado, fn($q) => $q->where('grado', $this->filtroGrado))
            ->when(
                $this->filtroEstudiante,
                fn($q) =>
                $q->whereHas(
                    'estudiante',
                    fn($q2) =>
                    $q2->where('name', 'like', '%' . $this->filtroEstudiante . '%')
                )
            );

        $matriculas = $matriculasQuery->paginate($this->perPage);
        $grados = $matriculasQuery->pluck('grado')->unique()->sort()->values();

        // Aquí pasamos el modelo completo del estudiante y su tutor_id
        $resumen = $matriculas->map(function ($matricula) {
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

            if ($porCompetencia->isEmpty()) {
                return (object)[
                    'estudiante' => $estudiante, // <-- Pasamos el modelo completo
                    'grado' => $matricula->grado,
                    'competencia' => '-',
                    'total_actividades' => 0,
                    'puntaje_promedio' => 0,
                ];
            } else {
                return collect($porCompetencia)->map(fn($c) => (object)[
                    'estudiante' => $estudiante, // <-- Pasamos el modelo completo
                    'grado' => $matricula->grado,
                    'competencia' => $c['competencia'],
                    'total_actividades' => $c['total_actividades'],
                    'puntaje_promedio' => $c['puntaje_promedio'],
                ])->all();
            }
        })->flatten();

        return view('livewire.docente-panel', [
            'resumenDesempeno' => $resumen,
            'grados' => $grados,
            'matriculas' => $matriculas,
        ]);
    }
}
