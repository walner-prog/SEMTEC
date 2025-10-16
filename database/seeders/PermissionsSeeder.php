<?php

namespace Database\Seeders;

use App\Livewire\Juegos;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Entidades principales del sistema SEMTEC
        $entities = [
            'escuela',
            'grado',
            'juegos',
            'unidad',
            'competencia',
            'indicador',
            'actividad',
            'user',
            'role',
            'permiso',
        ];

        // 🔹 Acciones por entidad
        $actions = ['_ver', '_crear', '_editar', '_eliminar'];

        // 🔹 Roles principales
        $adminRole    = Role::firstOrCreate(['name' => 'Administrador']);
        $docenteRole  = Role::firstOrCreate(['name' => 'Docente']);
        $estudianteRole = Role::firstOrCreate(['name' => 'Estudiante']);
        $tutorRole    = Role::firstOrCreate(['name' => 'Tutor']);

        // 🔹 Crear todos los permisos y asignarlos al Administrador
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permissionName = $entity . $action;

                $permission = Permission::firstOrCreate([
                    'name'       => $permissionName,
                    'guard_name' => 'web',
                ]);

                $adminRole->givePermissionTo($permission);
            }
        }

        // 🔹 Permisos para DOCENTE
        $docentePermissions = [
            'unidad_ver',
            'unidad_crear',
            'unidad_editar',
            'competencia_ver',
            'competencia_crear',
            'competencia_editar',
            'indicador_ver',
            'indicador_crear',
            'indicador_editar',
            'actividad_ver',
            'actividad_crear',
            'actividad_editar',
        ];

        // 🔹 Permisos para ESTUDIANTE
        $estudiantePermissions = [
            'unidad_ver',
            'competencia_ver', 
            'indicador_ver',
            'actividad_ver',
            'juegos_ver',
        ];

        // 🔹 Permisos para TUTOR
        $tutorPermissions = [
            'unidad_ver',
            'competencia_ver',
            'indicador_ver',
            'actividad_ver',
            'user_ver', // ver avance de su hijo(a)
        ];

        // Asignar los permisos correspondientes
        foreach ($docentePermissions as $perm) {
            $p = Permission::where('name', $perm)->first();
            if ($p) $docenteRole->givePermissionTo($p);
        }

        foreach ($estudiantePermissions as $perm) {
            $p = Permission::where('name', $perm)->first();
            if ($p) $estudianteRole->givePermissionTo($p);
        }

        foreach ($tutorPermissions as $perm) {
            $p = Permission::where('name', $perm)->first();
            if ($p) $tutorRole->givePermissionTo($p);
        }

        $this->command->info('✅ Permisos y roles creados/actualizados correctamente para SEMTEC.');
    }
}
