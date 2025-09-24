<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Obtener el rol Docente
        $DocenteRole = Role::where('name', 'Docente')->first();

        // Lista fija de usuarios
        $usuarios = [
            ['name' => 'José Martínez', 'username' => 'jose'],
            ['name' => 'Mario López', 'username' => 'mario'],
            
        ];

        foreach ($usuarios as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'username' => $data['username'],
                'email'    => null, // 🚨 Sin email
                'password' => Hash::make('12345678'),
            ]);

            // Asignar rol Docente
            if ($DocenteRole) {
                $user->assignRole($DocenteRole);
            }
        }
    }
}
