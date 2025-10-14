<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
 

class PerfilUsuario extends Component
{
    use WithFileUploads;

    public $name, $username, $email, $password, $role;
    public $profile_photo_path, $profilePhotoTemp, $profilePhotoDeleteTempUrl;
    public $modalOpen = false;
    public bool $isAdmin = false;

    // Campos por rol
    public $escuela, $grados = [], $grado, $seccion, $docente, $accesibilidad = [];

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first() ?? 'Sin rol';
        $this->profilePhotoTemp = $user->profile_photo_path;
        $this->isAdmin = $user->hasRole('Administrador');

        // Mostrar datos adicionales según el rol
        if ($user->hasRole('Docente')) {
    $this->escuela = $user->escuela?->nombre;
    $this->grados = $user->grados?->pluck('nombre')->toArray();
}

if ($user->hasRole('Estudiante')) {
    $matricula = $user->matriculas()
        ->with(['escuela', 'docente']) // ya no necesitamos 'grado' como relación
        ->latest()
        ->first();

    $this->escuela = $matricula?->escuela?->nombre ?? '--';
    $this->grado = $matricula?->grado ?? '--'; // <- aquí usamos directamente la columna 'grado'
    $this->seccion = $matricula?->seccion ?? '--';
    $this->docente = $matricula?->docente?->name ?? '--';
    $this->accesibilidad = json_decode($user->preferencias_accesibilidad, true) ?? [];
}


    }

    public function updatedProfilePhotoPath()
    {
        $imageData = base64_encode(file_get_contents($this->profile_photo_path->getRealPath()));
        $nombreArchivo = 'perfil_' . time() . '.' . $this->profile_photo_path->getClientOriginalExtension();

        $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
            'key'   => '0ba2bdf79d7d4216d6f3a3efb37e9fc7',
            'image' => $imageData,
            'name'  => $nombreArchivo,
        ]);

        if ($response->successful() && $response->json('success')) {
            $this->profilePhotoTemp = $response->json('data.url');
            $this->profilePhotoDeleteTempUrl = $response->json('data.delete_url');
        } else {
            session()->flash('error', '❌ No se pudo subir la foto.');
        }
    }

    public function actualizar()
    {
        $user = Auth::user();
        $isAdmin = $user->hasRole('Administrador');

        $rules = ['name' => 'required|string|min:2|max:255'];
        if ($isAdmin) {
            $rules['username'] = 'required|string|unique:users,username,' . $user->id;
            $rules['email'] = 'nullable|email|unique:users,email,' . $user->id;
            $rules['password'] = 'nullable|string|min:6';
        }

        $data = $this->validate($rules);

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->profilePhotoTemp && $this->profilePhotoTemp !== $user->profile_photo_path) {
            if ($user->delete_profile_photo_path) {
                Http::get($user->delete_profile_photo_path);
            }
            $data['profile_photo_path'] = $this->profilePhotoTemp;
            $data['delete_profile_photo_path'] = $this->profilePhotoDeleteTempUrl;
        }

        $user->update($data);
        session()->flash('update', ' Perfil actualizado correctamente');
        $this->modalOpen = false;
    }

    public function render()
    {
        return view('livewire.perfil-usuario');
    }
}
