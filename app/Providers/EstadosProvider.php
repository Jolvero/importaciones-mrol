<?php

namespace App\Providers;

use App\EstadoEmbarque;
use View;
use Illuminate\Support\ServiceProvider;

class EstadosProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $estados = EstadoEmbarque::all();
            $view->with('estados', $estados);
        });
    }
}
