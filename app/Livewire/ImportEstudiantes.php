<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Matricula;
use App\Models\Escuela;
use App\Models\Grado;
use Illuminate\Support\Facades\Hash;


class ImportEstudiantes extends Component
{
    use WithFileUploads;

    public $file;
    public $escuela_id;
    public $grado_id;
    public $seccion;
    public $docente_id;
    public $tutor_id;

    public $escuelas;
    public $grados;
    public $docentes;
    public $tutores;

    public function mount()
    {
        // Cargar datos para selects
        $this->escuelas = Escuela::all();
        $this->grados = Grado::all();
        $this->docentes = User::role('Docente')->get();
        $this->tutores = User::role('Tutor')->get();
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt',
            'escuela_id' => 'required|exists:escuelas,id',
            'grado_id' => 'required|exists:grados,id',
            'seccion' => 'required|string|max:2',
            'docente_id' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id',
        ];
    }

    public function import()
    {
        $this->validate();

        if (($handle = fopen($this->file->getRealPath(), 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data = array_combine($header, $row);

                $usuario = User::withTrashed()->firstOrCreate(
                    ['username' => $data['username']],
                    [
                        'name' => $data['name'],
                        'email' => $data['email'] ?? $data['username'] . '@example.com',
                        'password' => Hash::make($data['password'] ?? '123456'),
                        'escuela_id' => $this->escuela_id,
                        'tutor_id' => $this->tutor_id,
                    ]
                );

                $usuario->syncRoles(['Estudiante']);

                Matricula::updateOrCreate(
                    ['user_id' => $usuario->id, 'anio' => date('Y')],
                    [
                        'grado' => $this->grado_id,
                        'seccion' => $this->seccion,
                        'docente_id' => $this->docente_id,
                        'escuela_id' => $this->escuela_id,
                        'fecha_matricula' => now(),
                        'observaciones' => 'Importado vía CSV',
                    ]
                );

                $usuario->grados()->sync([$this->grado_id]);
            }

            fclose($handle);
        }

        session()->flash('success', 'Estudiantes importados correctamente.');
        $this->reset('file');
    }

    public function render()
    {
        return view('livewire.import-estudiantes', [
            'escuelas' => $this->escuelas,
            'grados' => $this->grados,
            'docentes' => $this->docentes,
            'tutores' => $this->tutores,
        ]);
    }
}
