<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use App\Livewire\Forms\UsuarioForm;
use Livewire\WithPagination;

class UsuariosList extends Component
{
    use WithPagination, WithFileUploads;

    public UsuarioForm $form;
    public $isOpen = false;
    public $modo = 'crear'; // crear | editar
    public $search = '';
    public $verModal = false;
    public $usuarioVer = null;
    public $modalConfirmar = false;
    public $usuarioIdAEliminar = null;

    // 🔹 Estado para menú de acciones
    public $menuAccionId = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // -------------------------------
    // 📌 Menú Acciones
    // -------------------------------
    public function toggleMenu($id)
    {
        $this->menuAccionId = $this->menuAccionId === $id ? null : $id;
    }

    public function closeMenu()
    {
        $this->menuAccionId = null;
    }

    // -------------------------------
    // 📌 CRUD
    // -------------------------------
    public function abrirModalCrear()
    {

        $limite = 10000;
        $totalUsuarios = \App\Models\User::whereNull('deleted_at')->count();

        if ($totalUsuarios >= $limite) {
            session()->flash(
                'error',
                "Ya alcanzaste el límite máximo de usuarios permitidos ({$totalUsuarios}/{$limite})."
            );
            return; // ❌ No abre modal
        }

        $this->resetForm();
        $this->form->roles = \App\Models\Role::all();

        $this->modo = 'crear';
        $this->isOpen = true;
    }

    public function abrirModalEditar($id)
    {
        $this->resetForm();
        $usuario = User::findOrFail($id);
        $this->form->setUsuario($usuario);

        $this->modo = 'editar';
        $this->isOpen = true;
        $this->closeMenu();
    }

    public function cerrarModal()
    {
        $this->isOpen = false;
    }

    public function guardar()
    {
        if ($this->modo === 'crear') {

            
             $role = \Spatie\Permission\Models\Role::find($this->form->role_id);
            // Si intenta asignar "Administrador" y ya existe uno, bloquear la acción
            if ($role && $role->name === 'Administrador' && $this->form->ComprobarSiYaExixteUsuarioAdministrador()) {
                session()->flash('error', '⚠️ Ya existe un usuario con rol Administrador.');

                $this->resetForm();
                $this->isOpen = false;
                return;
            }

            $this->form->store();
            session()->flash('create', '✅ Usuario creado correctamente.');
        } else {
            $this->form->update();
            session()->flash('update', '✏️ Usuario actualizado correctamente.');
        }

        $this->resetForm();
        $this->isOpen = false;
    }

    // -------------------------------
    // 📌 Eliminar
    // -------------------------------
    public function confirmarEliminar($id)
    {
        $this->usuarioIdAEliminar = $id;
        $this->modalConfirmar = true;
        $this->closeMenu();
    }

    public function eliminarConfirmado()
    {
        $usuario = User::findOrFail($this->usuarioIdAEliminar);

        // Bloquear eliminación de Administrador o email específico
        if ($usuario->roles->contains('name', 'Administrador') || $usuario->email === 'ca140611@gmail.com') {
            session()->flash('error', '⚠️ No puedes eliminar al usuario administrador.');
            $this->modalConfirmar = false;
            $this->usuarioIdAEliminar = null;
            return;
        }



        // Eliminación segura
        $usuario->delete();
        session()->flash('delete', '🗑️ Usuario eliminado correctamente.');
        $this->resetPage();

        $this->modalConfirmar = false;
        $this->usuarioIdAEliminar = null;
    }

    public function resetForm()
    {
        $this->form->reset();
        $this->form->usuario = null;
    }

    // -------------------------------
    // 📌 Ver Detalles
    // -------------------------------
    public function abrirModalVer($id)
    {
        $this->usuarioVer = User::findOrFail($id);
        $this->verModal = true;
        $this->closeMenu();
    }

    public function cerrarModalVer()
    {
        $this->usuarioVer = null;
        $this->verModal = false;
    }

    // -------------------------------
    // 📌 Render
    // -------------------------------
    public function render()
    {
        $usuarios = User::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(5);

        return view('livewire.usuarios-list', compact('usuarios'));
    }
}
