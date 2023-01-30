<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoImportaciónSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipoImportación')->insert([
            'tipo' => 'AICM'
        ]);

        DB::table('tipoImportación')->insert([
            'tipo' => 'Mzo'
        ]);
    }
}
