<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Matricula;


class UsuarioForm extends Form
{
    use WithFileUploads;

    public $name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $profile_photo_path;
    public $profilePhotoTemp;
    public $profilePhotoDeleteTempUrl;
    public $roles = [];
    public $role_id = null;
    public ?User $usuario = null;
    public $escuela_id = null;
    public $grados = [];
    public $grado_id = null;
    public $seccion = null;
    public $accesibilidad = [];
    public $docente_id = null;
    public $tutor_id = null;

    public function mount()
    {
        $this->roles = Role::orderBy('name')->get();
    }

    
    public function ComprobarSiYaExixteUsuarioAdministrador(): bool
    {
        $adminRole = Role::where('name', 'Administrador')->first();
        if (!$adminRole) {
            return false;  
        }

        $adminUsersCount = User::role('Administrador')->count();
        return $adminUsersCount > 0;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'username' => [
                'required',
                'string',
                Rule::unique('users', 'username')->ignore($this->usuario?->id)->whereNull('deleted_at')
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->usuario?->id)->whereNull('deleted_at')
            ],
            'password' => [$this->usuario ? 'nullable' : 'required', 'string', 'min:6'],
            'role_id' => ['required', 'exists:roles,id'],
            'profile_photo_path' => ['nullable', 'image', 'max:2048'],
        ];

        if ($this->role_id) {
            $role = Role::find($this->role_id)?->name;



            if ($role === 'Docente') {
                $rules['escuela_id'] = ['required', 'exists:escuelas,id'];
                $rules['grados'] = ['required', 'array', 'min:1'];
            }

            if ($role === 'Estudiante') {
                $rules['escuela_id'] = ['required', 'exists:escuelas,id'];
                $rules['grado_id'] = ['required', 'exists:grados,id'];
                $rules['seccion'] = ['required', 'string', 'max:2'];
                $rules['docente_id'] = ['required', 'exists:users,id'];
                $rules['tutor_id'] = ['required', 'exists:users,id'];
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Debes seleccionar un rol.',
            'cartera_id.required' => 'La cartera es obligatoria para el rol de Cobrador.',
            'escuela_id.required' => 'La escuela es obligatoria.',
            'grado_id.required' => 'El grado es obligatorio.',
            'docente_id.required' => 'El docente asignado es obligatorio.',
        ];
    }

    public function setUsuario(User $usuario)
    {
        $this->usuario = $usuario;
        $this->name = $usuario->name;
        $this->username = $usuario->username;
        $this->email = $usuario->email;
        $this->role_id = $usuario->roles()->pluck('id')->first();
        $this->escuela_id = $usuario->escuela_id;


        $this->grados = $usuario->grados()->pluck('grados.id')->toArray();


        if ($this->role_id) {
            $roleName = Role::find($this->role_id)?->name;
            if ($roleName === 'Estudiante') {
                $matricula = $usuario->matriculas()->latest()->first();
                if ($matricula) {
                    $this->grado_id = $matricula->grado;
                    $this->seccion = $matricula->seccion;
                    $this->docente_id = $matricula->docente_id;
                }
                $this->tutor_id = $usuario->tutor_id;


                $this->accesibilidad = json_decode($usuario->preferencias_accesibilidad, true) ?? [];
            }
        }

        $this->roles = Role::all();
    }



    public function updatedProfilePhotoPath()
    {
        if ($this->profilePhotoDeleteTempUrl) {
            Http::get($this->profilePhotoDeleteTempUrl);
            $this->profilePhotoTemp = null;
            $this->profilePhotoDeleteTempUrl = null;
        }

        $imageData = base64_encode(file_get_contents($this->profile_photo_path->getRealPath()));
        $prefijo = 'usuario_Empresa_carlosQ_';
        $extension = $this->profile_photo_path->getClientOriginalExtension();
        $nombreArchivo = $prefijo . time() . '.' . $extension;

        $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
            'key'   => '0ba2bdf79d7d4216d6f3a3efb37e9fc7',
            'image' => $imageData,
            'name'  => $nombreArchivo,
        ]);

        if ($response->successful() && $response->json('success')) {
            $this->profilePhotoTemp = $response->json('data.url');
            $this->profilePhotoDeleteTempUrl = $response->json('data.delete_url');
        } else {
            session()->flash('error', 'No se pudo subir la foto de perfil a Imgbb.');
        }
    }

    protected function payload(): array
    {
        $data = $this->only(['name', 'username', 'email']);

        // Si no trae email, generamos uno único
        if (empty($data['email'])) {
            // usar username si está, si no fallback con uniqid
            $unique = $this->username ?: uniqid('usr_');
            $data['email'] = $unique . '@usuario.com';
        }


        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->profilePhotoTemp) {
            if ($this->usuario && $this->usuario->delete_profile_photo_path) {
                Http::get($this->usuario->delete_profile_photo_path);
            }

            $data['profile_photo_path'] = $this->profilePhotoTemp;
            $data['delete_profile_photo_path'] = $this->profilePhotoDeleteTempUrl;

            $this->profilePhotoTemp = null;
            $this->profilePhotoDeleteTempUrl = null;
            $this->profile_photo_path = null;
        }

        return $data;
    }

    public function store()
    {
        $this->validate();
        $usuario = User::withTrashed()->where('username', $this->username)->first();

        if ($usuario) {
            if ($usuario->trashed()) {
                $usuario->restore();
                $usuario->update($this->payload());
            } else {
                return;
            }
        } else {
            $usuario = User::create($this->payload());
        }

        $this->assignRoleAndExtras($usuario);
    }

    public function update()
    {
        $this->validate();
        if (!$this->usuario) return;

        $this->usuario->update($this->payload());

        $this->assignRoleAndExtras($this->usuario, true);
    }

    private function assignRoleAndExtras(User $usuario, bool $updating = false)
    {
        if (!$this->role_id) return;

        $role = Role::find($this->role_id);
        if (!$role) return;

        $usuario->syncRoles([$role->name]);


        if ($role->name === 'Docente') {
            $usuario->update(['escuela_id' => $this->escuela_id]);
            $usuario->grados()->sync($this->grados); // sincroniza los múltiples grados
        }


        if ($role->name === 'Estudiante') {
            $usuario->update([
                'escuela_id' => $this->escuela_id,
                'tutor_id'   => $this->tutor_id,
                'preferencias_accesibilidad' => json_encode($this->accesibilidad),
            ]);

            if ($updating) {
                $usuario->matriculas()->delete();
            }

            Matricula::create([
                'user_id' => $usuario->id,
                'docente_id' => $this->docente_id,
                'escuela_id' => $this->escuela_id,
                'anio' => date('Y'),
                'grado' => $this->grado_id,
                'seccion' => $this->seccion,
            ]);

            $usuario->grados()->sync([$this->grado_id]);
        }
    }
}
