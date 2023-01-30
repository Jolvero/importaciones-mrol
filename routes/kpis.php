<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth;

Route::get('/kpis/{mes}/{tipo}/{cliente}', 'KpiController@obtenerKpis')->name('kpi.get');
Route::get('/kpis', 'KpiController@index')->name('kpis.index');
