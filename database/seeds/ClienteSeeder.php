<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('clientes')->insert([
            'cliente' => Crypt::encryptString('ZTE')
        ]);

        DB::table('clientes')->insert([
            'cliente' => Crypt::encryptString('VIVO')
        ]);

        DB::table('clientes')->insert([
            'cliente' => Crypt::encryptString('OPPO')
        ]);

        DB::table('clientes')->insert([
            'cliente' => Crypt::encryptString('REALME')
        ]);

        DB::table('clientes')->insert([
            'cliente' => Crypt::encryptString('XIAOMI')
        ]);

    }
}
