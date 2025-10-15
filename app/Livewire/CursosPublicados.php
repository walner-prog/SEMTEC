<?php

namespace App\Livewire;
 

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;

class CursosPublicados extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $categoria = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoria()
    {
        $this->resetPage();
    }

    public function render()
    {
        $cursosPublicados = Curso::query()
            ->where('publicado', true)
            ->when($this->search, fn($q) => $q->where('titulo', 'like', "%{$this->search}%"))
            ->when($this->categoria, fn($q) => $q->where('categoria', $this->categoria))
            ->latest()
            ->paginate(92);

        return view('livewire.cursos-publicados', compact('cursosPublicados'));
    }
}
