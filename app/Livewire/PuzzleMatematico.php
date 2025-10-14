<?php

namespace App\Livewire;

 
use Livewire\Component;

class PuzzleMatematico extends Component
{
    public $piezas = [];
    public $piezasOrdenadas = [];
    public $completado = false;

    public function mount()
    {
        // Ejemplo de puzzle con 4 piezas
        $this->piezas = [
            ['id' => 1, 'numero' => 2],
            ['id' => 2, 'numero' => 1],
            ['id' => 3, 'numero' => 4],
            ['id' => 4, 'numero' => 3],
        ];

        // Desordenamos las piezas
        shuffle($this->piezas);
    }

    public function moverPieza($id, $pos)
    {
        $this->piezasOrdenadas[$pos] = $id;

        // Revisar si el puzzle está completo
        $ordenCorrecto = [2,1,4,3]; // la secuencia correcta
        $idsOrdenados = array_map(fn($pid) => $this->piezas[$pid-1]['numero'] ?? null, $this->piezasOrdenadas);

        if ($idsOrdenados === $ordenCorrecto) {
            $this->completado = true;
        }
    }

    public function render()
    {
        return view('livewire.puzzle-matematico');
    }
}
