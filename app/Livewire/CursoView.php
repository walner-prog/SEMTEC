<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Curso;

class CursoView extends Component
{
    public $curso;
    public $lecciones = [];
    public $indiceActual = 0;

    public function mount($cursoId)
    {
        $this->curso = Curso::with('lecciones')->findOrFail($cursoId);
        $this->lecciones = $this->curso->lecciones->sortBy('orden')->values()->all();
    }

    public function seleccionarLeccion($index)
    {
        $this->indiceActual = $index;
    }

    public function siguiente()
    {
        if ($this->indiceActual < count($this->lecciones) - 1) {
            $this->indiceActual++;
        }
    }

    public function anterior()
    {
        if ($this->indiceActual > 0) {
            $this->indiceActual--;
        }
    }

    // Método estático para generar URL embebida
    public static function youtubeEmbedUrl($url)
    {
        if (preg_match('/v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://www.youtube.com/embed/" . $matches[1];
        }

        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return "https://www.youtube.com/embed/" . $matches[1];
        }

        return null;
    }

    public function render()
    {
        $leccionActual = $this->lecciones[$this->indiceActual] ?? null;

        return view('livewire.curso-view', [
            'leccionActual' => $leccionActual,
            'lecciones' => $this->lecciones
        ]);
    }
}
