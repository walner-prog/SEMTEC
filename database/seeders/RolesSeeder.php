<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $adminRole    = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);


        // Crear usuario administrador si no existe
        $user = User::firstOrCreate(
            ['email' => null],
            [
                'name'     => 'Carlos Gonzalez',
                'username' => 'carlos', // ← Nuevo campo username
                'password' => Hash::make('12345'),
            ]
        );

        // Asegurar que el admin tenga solo el rol "Administrador"
        $user->syncRoles([$adminRole]);

         
    }
}
