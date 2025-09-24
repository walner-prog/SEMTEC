<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Intento;
use App\Models\Revision;
use App\Models\User;
use App\Models\Grado;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class DocenteReportesDesempeno extends Component
{
    public $grado_id = '';
    public $unidad_id = '';
    public $competencia_id = '';
    public $indicador_id = '';
    public $actividad_id = '';
    public $estudiante_id = '';
    public $fecha_inicio = '';
    public $fecha_fin = '';

    public $estudiantes = [];
    public $reporteData = [];

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

    public function updatedGradoId($value)
    {
        $this->reset(['unidad_id', 'competencia_id', 'indicador_id', 'actividad_id', 'estudiante_id', 'estudiantes']);
        if ($value) {
            // Obtener estudiantes del grado seleccionado
            $this->estudiantes = User::whereHas('grados', function($query) use ($value) {
                $query->where('grado_id', $value);
            })->whereDoesntHave('roles', function($query) {
                $query->where('name', 'Docente');
            })->get();
        }
    }

   public function generarReporte()
{
    $this->validate([
        'estudiante_id' => 'required|exists:users,id',
        'fecha_inicio' => 'nullable|date',
        'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio'
    ]);

    $query = Intento::with([
            'usuario',
            'actividad.indicador.competencia.unidad',
            'revision'
        ])
        ->where('user_id', $this->estudiante_id);

    // 🔹 Filtros dinámicos
    if ($this->grado_id) {
        $query->whereHas('actividad.indicador.competencia.unidad', function($q) {
            $q->where('grado_id', $this->grado_id);
        });
    }

    if ($this->unidad_id) {
        $query->whereHas('actividad.indicador.competencia', function($q) {
            $q->where('unidad_id', $this->unidad_id);
        });
    }

    if ($this->competencia_id) {
        $query->whereHas('actividad.indicador', function($q) {
            $q->where('competencia_id', $this->competencia_id);
        });
    }

    if ($this->indicador_id) {
        $query->whereHas('actividad', function($q) {
            $q->where('indicador_id', $this->indicador_id);
        });
    }

    if ($this->actividad_id) {
        $query->where('actividad_id', $this->actividad_id);
    }

    if ($this->fecha_inicio) {
        $query->whereDate('created_at', '>=', $this->fecha_inicio);
    }

    if ($this->fecha_fin) {
        $query->whereDate('created_at', '<=', $this->fecha_fin);
    }

    $intentos = $query->orderBy('created_at', 'desc')->get();

    // 📊 Calcular estadísticas
    $totalActividades = $intentos->count();
    $actividadesCompletadas = $intentos->whereNotNull('fin')->count();
    $promedioAciertos = $totalActividades > 0 ? $intentos->avg('aciertos') : 0;
    $promedioPuntaje = $totalActividades > 0 ? $intentos->avg('puntaje') : 0;
    $actividadesRevisadas = $intentos->filter(fn($i) => $i->revision && $i->revision->revisado)->count();

    $this->reporteData = [
        'intentos' => $intentos,
        'estadisticas' => [
            'total_actividades' => $totalActividades,
            'actividades_completadas' => $actividadesCompletadas,
            'porcentaje_completado' => $totalActividades > 0 ? round(($actividadesCompletadas / $totalActividades) * 100, 2) : 0,
            'promedio_aciertos' => round($promedioAciertos, 2),
            'promedio_puntaje' => round($promedioPuntaje, 2),
            'actividades_revisadas' => $actividadesRevisadas,
            'porcentaje_revisado' => $totalActividades > 0 ? round(($actividadesRevisadas / $totalActividades) * 100, 2) : 0,
        ],
        'estudiante' => User::find($this->estudiante_id),
        'filtros' => [
            'grado' => $this->grado_id ? Grado::find($this->grado_id)->nombre : 'Todos',
            'unidad' => $this->unidad_id ? Unidad::find($this->unidad_id)->titulo : 'Todas',
            'competencia' => $this->competencia_id ? Competencia::find($this->competencia_id)->titulo : 'Todas',
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]
    ];
}


    public function descargarPDF()
    {
        if (empty($this->reporteData)) {
            session()->flash('error', 'Primero debe generar el reporte.');
            return;
        }

        $pdf = Pdf::loadView('pdf.reporte-desempeno', $this->reporteData);

        $nombreArchivo = 'reporte_desempeno_' . $this->reporteData['estudiante']->name . '_' . date('Y-m-d') . '.pdf';

        return Response::streamDownload(
            function () use ($pdf) {
                echo $pdf->stream();
            },
            $nombreArchivo
        );
    }

    public function descargarExcel()
    {
        if (empty($this->reporteData)) {
            session()->flash('error', 'Primero debe generar el reporte.');
            return;
        }

        $nombreArchivo = 'reporte_desempeno_' . $this->reporteData['estudiante']->name . '_' . date('Y-m-d') . '.xlsx';

        // Aquí puedes implementar la generación de Excel usando Maatwebsite/Laravel-Excel
        // Por ahora, retornamos un mensaje
        session()->flash('info', 'Funcionalidad de Excel en desarrollo. Use PDF por ahora.');
    }

    public function render()
    {
        return view('livewire.docente-reportes-desempeno', [
            'grados' => $this->grados,
            'unidades' => $this->unidades,
            'competencias' => $this->competencias,
            'indicadores' => $this->indicadores,
            'actividades' => $this->actividades,
        ]);
    }
}