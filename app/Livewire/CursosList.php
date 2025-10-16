<?php

namespace App\Livewire;

 

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;
use App\Models\Leccion;
use Illuminate\Support\Facades\Auth;

class CursosList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

   
    public $titulo;
    public $descripcion;
    public $categoria = 'Inclusión';
    public $publicado = false;
    public $curso_id = null;

    
    public $lecciones = [
        ['titulo' => '', 'descripcion' => '', 'youtube_url' => '', 'orden' => 1]
    ];

   
    public $isOpen = false;
    public $modo = 'crear';
    public $search = '';
    public $modalConfirmar = false;
    public $cursoIdAEliminar = null;
 
    protected $rules = [
        'titulo' => 'required|string|min:3|max:150',
        'descripcion' => 'nullable|string|max:1000',
        'categoria' => 'required|string|max:100',
        'publicado' => 'boolean',
        'lecciones.*.titulo' => 'required|string|min:3|max:150',
        'lecciones.*.youtube_url' => 'nullable|url',
        'lecciones.*.orden' => 'integer|min:1',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function abrirModalCrear()
    {
        $this->resetForm();
        $this->modo = 'crear';
        $this->isOpen = true;
    }

    public function abrirModalEditar($id)
    {
        $curso = Curso::with('lecciones')->findOrFail($id);

        $this->curso_id = $curso->id;
        $this->titulo = $curso->titulo;
        $this->descripcion = $curso->descripcion;
        $this->categoria = $curso->categoria;
        $this->publicado = $curso->publicado;

        
        $this->lecciones = $curso->lecciones->map(function ($l) {
            return [
                'titulo' => $l->titulo,
                'descripcion' => $l->descripcion,
                'youtube_url' => $l->youtube_url,
                'orden' => $l->orden,
            ];
        })->toArray();

        $this->modo = 'editar';
        $this->isOpen = true;
    }

    public function agregarLeccion()
    {
        $this->lecciones[] = ['titulo' => '', 'descripcion' => '', 'youtube_url' => '', 'orden' => count($this->lecciones) + 1];
    }

    public function eliminarLeccion($index)
    {
        unset($this->lecciones[$index]);
        $this->lecciones = array_values($this->lecciones);
    }

    public function guardar()
    {
        $this->validate();

        if ($this->modo === 'crear') {
            $curso = Curso::create([
                'user_id' => Auth::id(),
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion,
                'categoria' => $this->categoria,
                'publicado' => $this->publicado,
            ]);

            
            foreach ($this->lecciones as $leccion) {
                $curso->lecciones()->create($leccion);
            }

            session()->flash('create', 'Curso y lecciones creados correctamente.');
        } else {
            $curso = Curso::findOrFail($this->curso_id);
            $curso->update([
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion,
                'categoria' => $this->categoria,
                'publicado' => $this->publicado,
            ]);

             
            $curso->lecciones()->delete();
            foreach ($this->lecciones as $leccion) {
                $curso->lecciones()->create($leccion);
            }

            session()->flash('update', 'Curso y lecciones actualizados correctamente.');
        }

        $this->resetForm();
        $this->isOpen = false;
    }

    public function confirmarEliminar($id)
    {
        $this->cursoIdAEliminar = $id;
        $this->modalConfirmar = true;
    }

    public function eliminarConfirmado()
    {
        $curso = Curso::findOrFail($this->cursoIdAEliminar);
        $curso->lecciones()->delete();
        $curso->delete();

        session()->flash('delete', 'Curso eliminado correctamente.');

        $this->modalConfirmar = false;
        $this->cursoIdAEliminar = null;
    }

    public function resetForm()
    {
        $this->reset(['titulo', 'descripcion', 'categoria', 'publicado', 'curso_id', 'lecciones']);
        $this->lecciones = [['titulo' => '', 'descripcion' => '', 'youtube_url' => '', 'orden' => 1]];
    }

  public function render()
{
    $userId = auth()->id();  

    
    $misCursos = Curso::query()
        ->with('docente')
        ->where('user_id', $userId)
        ->where('titulo', 'like', "%{$this->search}%")
        ->latest()
        ->paginate(124, ['*'], 'misCursosPage');  

     
    $cursosPublicados = Curso::query()
        ->with('docente')
        ->where('publicado', true)
        ->latest()
        ->paginate(124, ['*'], 'publicadosPage');  

    return view('livewire.cursos-list', compact('misCursos', 'cursosPublicados'));
}

}

