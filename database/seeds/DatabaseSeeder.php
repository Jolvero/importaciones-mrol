<?php

use App\DespachoProceso;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EstadosSeeder::class);
         $this->call(UsuarioSeeder::class);
         $this->call(DocumentaciónSeeder::class);
         $this->call(ClienteSeeder::class);
         $this->call(MesesSeeder::class);
         $this->call(TipoImportaciónSeeder::class);
         $this->call(DespachoProcesoSeed::class);
        // $this->call(UsersTableSeeder::class);
    }
}
