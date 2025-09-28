<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Escuela;
use App\Models\Grado;
use Illuminate\Validation\Rule;

class EscuelasList extends Component
{
    use WithPagination;

    public $form = [];
    public $isOpen = false;
    public $modo = 'crear';
    public $modalConfirmar = false;
    public $escuelaIdAEliminar = null;
    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->resetForm();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->form = [
            'escuela_id' => null,
            'nombre' => '',
            'direccion' => '',
            'telefono' => '',
            'codigo_mined' => '',
            'municipio' => '',
            'departamento' => '',
            'pais' => 'Nicaragua',
            'tipo' => '',
            'anio_fundacion' => '',
            'director' => '',
            'grados' => [],
        ];
    }

    public function abrirModalCrear()
    {
        $this->resetForm();
        $this->modo = 'crear';
        $this->isOpen = true;
    }

    public function abrirModalEditar($id)
    {
        $escuela = Escuela::with('grados')->findOrFail($id);

        $this->form = [
            'escuela_id' => $escuela->id,
            'nombre' => $escuela->nombre,
            'direccion' => $escuela->direccion,
            'telefono' => $escuela->telefono,
            'codigo_mined' => $escuela->codigo_mined,
            'municipio' => $escuela->municipio,
            'departamento' => $escuela->departamento,
            'pais' => $escuela->pais,
            'tipo' => $escuela->tipo,
            'anio_fundacion' => $escuela->anio_fundacion,
            'director' => $escuela->director,
            'grados' => $escuela->grados->map(fn($g) => [
                'id' => $g->id,
                'nombre' => $g->nombre,
                'descripcion' => $g->descripcion,
                'orden' => $g->orden
            ])->toArray(),
        ];

        $this->modo = 'editar';
        $this->isOpen = true;
    }

    public function addGrado()
    {
        $this->form['grados'][] = [
            'nombre' => '',
            'descripcion' => '',
            'orden' => 0
        ];
    }

    public function removeGrado($index)
    {
        unset($this->form['grados'][$index]);
        $this->form['grados'] = array_values($this->form['grados']);
    }

    public function guardar()
    {
        $rules = [
            'form.nombre' => ['required', 'string', 'max:255', Rule::unique('escuelas','nombre')->ignore($this->form['escuela_id'])],
            'form.grados.*.nombre' => ['required', 'string', 'max:255'],
        ];
        $this->validate($rules);

        if ($this->modo === 'crear') {
            $escuela = Escuela::create([
                'nombre' => $this->form['nombre'],
                'direccion' => $this->form['direccion'],
                'telefono' => $this->form['telefono'],
                'codigo_mined' => $this->form['codigo_mined'],
                'municipio' => $this->form['municipio'],
                'departamento' => $this->form['departamento'],
                'pais' => $this->form['pais'],
                'tipo' => $this->form['tipo'],
                'anio_fundacion' => $this->form['anio_fundacion'],
                'director' => $this->form['director'],
            ]);

            foreach ($this->form['grados'] as $grado) {
                $escuela->grados()->create($grado);
            }
            session()->flash('create', 'Escuela creada correctamente.');
        } else {
            $escuela = Escuela::findOrFail($this->form['escuela_id']);
            $escuela->update([
                'nombre' => $this->form['nombre'],
                'direccion' => $this->form['direccion'],
                'telefono' => $this->form['telefono'],
                'codigo_mined' => $this->form['codigo_mined'],
                'municipio' => $this->form['municipio'],
                'departamento' => $this->form['departamento'],
                'pais' => $this->form['pais'],
                'tipo' => $this->form['tipo'],
                'anio_fundacion' => $this->form['anio_fundacion'],
                'director' => $this->form['director'],
            ]);

            foreach ($this->form['grados'] as $grado) {
                if (isset($grado['id'])) {
                    $g = Grado::find($grado['id']);
                    if ($g) $g->update($grado);
                } else {
                    $escuela->grados()->create($grado);
                }
            }
            session()->flash('update', 'Escuela actualizada correctamente.');
        }

        $this->resetForm();
        $this->isOpen = false;
    }

    public function confirmarEliminar($id)
    {
        $this->escuelaIdAEliminar = $id;
        $this->modalConfirmar = true;
    }

    public function eliminarConfirmado()
    {
        $escuela = Escuela::findOrFail($this->escuelaIdAEliminar);
        $escuela->delete();
        session()->flash('delete', 'Escuela eliminada correctamente.');
        $this->modalConfirmar = false;
        $this->escuelaIdAEliminar = null;
        $this->resetPage();
    }

    public function render()
    {
        $escuelas = Escuela::query()
            ->where('nombre', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.escuelas-list', compact('escuelas'));
    }
}
