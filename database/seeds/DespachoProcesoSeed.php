<?php

use App\Despacho;
use App\DespachoProceso;
use Illuminate\Database\Seeder;

class DespachoProcesoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Unidades formadas';
        $despachoProceso->save();

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Proceso de carga';
        $despachoProceso->save();

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Ruta fiscal';
        $despachoProceso->save();

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Modulacion';
        $despachoProceso->save();

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Desaduanamiento';
        $despachoProceso->save();

        $despachoProceso = new Despacho();
        $despachoProceso->nombre = 'Reconocimiento';
        $despachoProceso->save();
    }
}
