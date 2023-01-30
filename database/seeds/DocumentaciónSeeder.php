<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentaciónSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('documentacion_embarques')->insert([
            'nombre' => 'Completa',
            'slug' => 'Completa'
        ]);

        DB::table('documentacion_embarques')->insert([
            'nombre' => 'Pendiente',
            'slug' => 'Pendiente'
        ]);

    }
}
