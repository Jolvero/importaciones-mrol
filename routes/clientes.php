<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/clientes', 'ClienteController@index')->name('cliente.index');
Route::get('/inventario/clientes', 'InventarioEmbarquesController@inventario')->name('clientes.inventario');
Route::get('/clientes/{cliente}/edit', 'ClienteController@edit')->name('cliente.edit');
Route::get('/cliente/importaciones', 'ClienteController@embarquesCliente')->name('cliente.importaciones.index');
Route::post('/cliente/store', 'ClienteController@store')->name('cliente.store');

Route::get('/clientes/all', 'ClienteController@clientesAjax');
Route::get('/clientes/nombres', 'ClienteController@clientesLabels');

Route::put('/clientes/{cliente}/update', 'ClienteController@update')->name('cliente.update');

Route::delete('/clientes/eliminar/{cliente}', 'ClienteController@destroy')->name('cliente.destroy');

Route::get('/cliente/buscar', 'ClienteController@buscar')->name('cliente.buscar');
