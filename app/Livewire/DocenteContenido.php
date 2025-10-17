<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Unidad;
use App\Models\Grado;
use App\Livewire\Forms\ContenidoForm;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class DocenteContenido extends Component
{
    public $step = 1;
    public $form = [
        'unidad' => ['titulo' => '', 'descripcion' => '', 'grado_id' => null, 'orden' => 0],
        'competencias' => [],
        'indicadores' => [],
        'actividades' => [],
    ];

    public $isOpen = false;
    public $modo = 'crear';
    public $grados = [];
    public ?Unidad $unidadSeleccionada = null;
    public $isDeleteModalOpen = false;
    public ?Unidad $unidadAEliminar = null;
    use WithPagination;
    public $search = '';
    public $grado_id = '';
    public $perPage = 100;





    // Agregar estas propiedades
    public $isViewOpen = false;
    public ?Unidad $unidadVer = null;
    public $formVer = [
        'unidad' => [],
        'competencias' => [],
        'indicadores' => [],
        'actividades' => [],
    ];


    public function abrirModalVer(Unidad $unidad)
    {
        $this->isViewOpen = true;
        $this->unidadVer = $unidad;

        $contenidoForm = new ContenidoForm();
        $this->formVer = $contenidoForm->cargarParaEditar($unidad);
    }


    public function cerrarModalVer()
    {
        $this->isViewOpen = false;
        $this->unidadVer = null;
        $this->formVer = [
            'unidad' => [],
            'competencias' => [],
            'indicadores' => [],
            'actividades' => [],
        ];
    }


    public function mount()
    {
        $this->grados = Grado::orderBy('orden')->get(['id', 'nombre']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingGradoId()
    {
        $this->resetPage();
    }

    public function cargarUnidades()
    {
        $this->resetPage();
    }

    public function abrirModal()
    {
        $this->isOpen = true;
        $this->modo = 'crear';
        $this->step = 1;
        $this->form = [
            'unidad' => ['titulo' => '', 'descripcion' => '', 'grado_id' => null, 'orden' => 0],
            'competencias' => [],
            'indicadores' => [],
            'actividades' => []
        ];
        $this->unidadSeleccionada = null;
    }

    public function abrirModalEditar(Unidad $unidad)
    {
        $this->isOpen = true;
        $this->modo = 'editar';
        $this->unidadSeleccionada = $unidad;
        $this->step = 1;

        $contenidoForm = new ContenidoForm();
        $this->form = $contenidoForm->cargarParaEditar($unidad);
    }

    public function guardar()
    {
        $contenidoForm = new ContenidoForm();
        try {
            $contenidoForm->guardar($this->form);
            $this->isOpen = false;
            session()->flash('create', 'Contenido creado con éxito 🎉');
        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function actualizar()
    {
        if (!$this->unidadSeleccionada) return;
        $contenidoForm = new ContenidoForm();
        try {
            $contenidoForm->actualizar($this->unidadSeleccionada, $this->form);
            $this->isOpen = false;
            session()->flash('update', 'Unidad actualizada con éxito 🎉');
        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }


    public function abrirModalEliminar(Unidad $unidad)
    {
        $this->unidadAEliminar = $unidad;
        $this->isDeleteModalOpen = true;
    }


    public function cerrarModalEliminar()
    {
        $this->unidadAEliminar = null;
        $this->isDeleteModalOpen = false;
    }


    public function confirmarEliminarUnidad()
    {
        if (!$this->unidadAEliminar) return;

        $this->unidadAEliminar->delete();
        session()->flash('delete', 'Unidad eliminada correctamente 🗑️');
        $this->cargarUnidades();
        $this->cerrarModalEliminar();
    }



    public function addCompetencia()
    {
        $this->form['competencias'][] = ['temp_id' => uniqid(), 'titulo' => '', 'descripcion' => '', 'orden' => count($this->form['competencias']) + 1];
    }
    public function addIndicador($compTempId)
    {
        $this->form['indicadores'][$compTempId][] = ['temp_id' => uniqid(), 'titulo' => '', 'descripcion' => '', 'orden' => count($this->form['indicadores'][$compTempId] ?? []) + 1];
    }
    public function addActividad($indTempId)
    {
        $this->form['actividades'][$indTempId][] = ['titulo' => '', 'objetivo' => '', 'tipo' => 'practica', 'accesibilidad_flags' => ['tts' => false, 'isn' => false], 'media_json' => [], 'dificultad_min' => 1, 'dificultad_max' => 3, 'orden' => count($this->form['actividades'][$indTempId] ?? []) + 1, 'items' => []];
    }
    public function addItem($indTempId, $actIndex)
    {
        $this->form['actividades'][$indTempId][$actIndex]['items'][] = [
            'enunciado' => '',
            'respuesta' => '',
            'orden' => count($this->form['actividades'][$indTempId][$actIndex]['items']) + 1,
            'datos' => [
                'tipo' => 'texto',
                'opciones' => []
            ]
        ];
    }

    public function addOpcion($indTempId, $actIndex, $itemIndex)
    {
        $this->form['actividades'][$indTempId][$actIndex]['items'][$itemIndex]['datos']['opciones'][] = '';
    }

    public function removeOpcion($indTempId, $actIndex, $itemIndex, $opcionIndex)
    {
        unset($this->form['actividades'][$indTempId][$actIndex]['items'][$itemIndex]['datos']['opciones'][$opcionIndex]);
        $this->form['actividades'][$indTempId][$actIndex]['items'][$itemIndex]['datos']['opciones'] = array_values(
            $this->form['actividades'][$indTempId][$actIndex]['items'][$itemIndex]['datos']['opciones']
        );
    }


    public function removeCompetencia($index)
    {
        $contenidoForm = new ContenidoForm();
        $contenidoForm->removeCompetencia($this->form, $index);
    }

    public function removeIndicador($compTempId, $indIndex)
    {
        $contenidoForm = new ContenidoForm();
        $contenidoForm->removeIndicador($this->form, $compTempId, $indIndex);
    }

    public function removeActividad($indTempId, $actIndex)
    {
        $contenidoForm = new ContenidoForm();
        $contenidoForm->removeActividad($this->form, $indTempId, $actIndex);
    }

    public function removeItem($indTempId, $actIndex, $itemIndex)
    {
        $contenidoForm = new ContenidoForm();
        $contenidoForm->removeItem($this->form, $indTempId, $actIndex, $itemIndex);
    }

    public function render()
    {
        $query = Unidad::with('grado')
            ->where('docente_id', auth()->id())
            ->orderBy('orden');

        if ($this->search) {
            $query->where('titulo', 'like', '%' . $this->search . '%');
        }

        if ($this->grado_id) {
            $query->where('grado_id', $this->grado_id);
        }

        $unidades = $query->paginate($this->perPage);


        return view('livewire.docente-contenido', [
            'unidades' => $unidades,
        ]);
    }
}
