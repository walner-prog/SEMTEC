<?php

namespace App\Livewire\Forms;

use App\Models\Escuela;
use App\Models\Grado;
use Illuminate\Validation\Rule;

class EscuelaForm
{
    public ?Escuela $escuela = null;

    public $nombre = '';
    public $direccion;
    public $telefono;
    public $codigo_mined;
    public $municipio;
    public $departamento;
    public $pais = 'Nicaragua';
    public $tipo;
    public $anio_fundacion;
    public $director;

    public $grados = [];

    public function mount()
    {
        if ($this->escuela) {
            $this->nombre = $this->escuela->nombre;
            $this->direccion = $this->escuela->direccion;
            $this->telefono = $this->escuela->telefono;
            $this->codigo_mined = $this->escuela->codigo_mined;
            $this->municipio = $this->escuela->municipio;
            $this->departamento = $this->escuela->departamento;
            $this->pais = $this->escuela->pais;
            $this->tipo = $this->escuela->tipo;
            $this->anio_fundacion = $this->escuela->anio_fundacion;
            $this->director = $this->escuela->director;

            $this->grados = $this->escuela->grados->map(fn($g) => [
                'id' => $g->id,
                'nombre' => $g->nombre,
                'descripcion' => $g->descripcion,
                'orden' => $g->orden
            ])->toArray();
        }
    }

    public function rules()
    {
        return [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('escuelas', 'nombre')->ignore($this->escuela?->id)],
            'direccion' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'codigo_mined' => ['nullable', 'string', 'max:100'],
            'municipio' => ['nullable', 'string', 'max:100'],
            'departamento' => ['nullable', 'string', 'max:100'],
            'pais' => ['required', 'string', 'max:100'],
            'tipo' => ['nullable', 'string', 'max:50'],
            'anio_fundacion' => ['nullable', 'integer'],
            'director' => ['nullable', 'string', 'max:255'],
            'grados' => ['array'],
            'grados.*.nombre' => ['required', 'string', 'max:255'],
            'grados.*.descripcion' => ['nullable', 'string'],
            'grados.*.orden' => ['nullable', 'integer'],
        ];
    }

    public function payload(): array
    {
        return [
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'codigo_mined' => $this->codigo_mined,
            'municipio' => $this->municipio,
            'departamento' => $this->departamento,
            'pais' => $this->pais,
            'tipo' => $this->tipo,
            'anio_fundacion' => $this->anio_fundacion,
            'director' => $this->director,
        ];
    }

    public function store()
    {
        $escuela = Escuela::create($this->payload());
        $this->guardarGrados($escuela);
    }

    public function update()
    {
        if (!$this->escuela) return;
        $this->escuela->update($this->payload());
        $this->guardarGrados($this->escuela);
    }

    protected function guardarGrados(Escuela $escuela)
    {
        foreach ($this->grados as $gradoData) {
            if (isset($gradoData['id'])) {
                $grado = Grado::find($gradoData['id']);
                if ($grado) $grado->update($gradoData);
            } else {
                $escuela->grados()->create($gradoData);
            }
        }
    }

    public function addGrado()
    {
        $this->grados[] = ['nombre' => '', 'descripcion' => '', 'orden' => 0];
    }

    public function removeGrado($index)
    {
        unset($this->grados[$index]);
        $this->grados = array_values($this->grados);
    }

    public function resetForm()
    {
        $this->nombre = '';
        $this->direccion = null;
        $this->telefono = null;
        $this->codigo_mined = null;
        $this->municipio = null;
        $this->departamento = null;
        $this->pais = 'Nicaragua';
        $this->tipo = null;
        $this->anio_fundacion = null;
        $this->director = null;
        $this->grados = [];
        $this->escuela = null;
    }
}
