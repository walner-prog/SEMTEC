<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Datos básicos del sistema
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);
      
        $this->call(ConfiguracionSeeder::class);
       // $this->call(MvpSeeder::class);
       // $this->call(EscuelaSeeder::class);
        $this->call(MvpCompletoSeeder::class);
        $this->call(JuegoSeeder::class);
        $this->call(RecompensaSeeder::class);
        $this->call(PreguntaSeeder::class);
        $this->call(PreguntaBloqueadosSeeder::class);
        $this->call(SeederPrimerNivel::class);
        $this->call(SeederSegundoNivel::class);
        $this->call(SeederTercerNivel::class);
        $this->call(SeederCuartoNivel::class);
        $this->call(SeederQuintoNivel::class);






      
       
        
        
       
      


      
    }
}
