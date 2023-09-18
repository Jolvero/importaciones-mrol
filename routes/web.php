<?php

use App\Prueba;
use App\Embarque;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PruebaResource;
use App\Http\Resources\PruebaCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get(
    '/',
    'InicioController@index'
)->name('inicio.index');

Route::get('/index','DashboardController@index')->name('index');
Route::get('/embarques', 'EmbarqueController@index')->name('embarques.index');
Route::get('/embarques/create', 'EmbarqueController@create')->name('embarques.create');
Route::post('/embarques', 'EmbarqueController@store')->name('embarques.store');
Route::get('/embarques/tipos', 'EmbarqueController@todosTipos');
Route::get('/existencias/{embarque}', 'EmbarqueController@validarExistencias');
Route::get('/embarques/cliente', 'EmbarqueController@todosClientes');
Route::get('/importacion/{embarque}', 'EmbarqueController@show')->name('embarques.show');
// dashboard
Route::get('/importaciones/mes', 'DashboardController@embarquesMes');
Route::get('/importaciones/mes/cliente', 'DashboardController@embarquesMesCliente');
Route::get('/embarques/top', 'DashboardController@obtenerTopMesEmbarques')->name('top.embarques');

Route::get('/importaciones/kpis', 'DashboardController@kpis');


Route::get('/graficas', 'KpiController@grafica');

Route::post('/imagenes/store', 'ImagenController@store')->name('imagenes.store');
Route::get('/embarques/{embarque}/edit', 'EmbarqueController@edit')->name('embarques.edit');
Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagenes.destroy');
Route::put('/embarques/{embarque}', 'EmbarqueController@update')->name('embarques.update');
Route::delete('/embarques/{embarque}/eliminar', 'EmbarqueController@destroy')->name('embarques.destroy');

Route::get('/embarques/{cliente}/filtro', 'EmbarqueController@filtrar')->name('embarques.filtrar');

// rutas de archivos de proforma

Route::get('/proforma/{proforma}', 'ProformaPedimentoController@show')->name('proforma.show');
Route::get('/proforma/{proforma}/edit', 'ProformaPedimentoController@edit')->name('proforma.edit');
Route::delete('/proforma/{proforma}', 'ProformaPedimentoController@destroy')->name('proforma.destroy');

Route::get('/home', 'HomeController@index')->name('home');
// Rutas de Archivos de documentación
Route::get('/file/{file}', 'FileController@show')->name('files.show');
Route::get('/file/{file}/edit', 'FileController@edit')->name('files.edit');
Route::delete('/file/{file}', 'FileController@destroy')->name('files.destroy');
Route::post('/upload', 'FileController@store')->name('users.files.store');

Route::get('/descargarprevio/{embarque}','EmbarqueController@descargarPrevios')->name('previo.descargar');

// Rutas de archivos de cuenta de gastos
Route::get('/cuenta/{cuenta}', 'CuentasController@show')->name('cuentas.show');
Route::get('/cuenta/{cuenta}/edit', 'CuentasController@edit')->name('cuentas.edit');
Route::delete('/cuenta/{cuenta}', 'CuentasController@destroy')->name('cuentas.destroy');

Route::get('/estado/{estadoEmbarque}', 'EstadosController@show')->name('estados.show');

// Buscador de embarques
Route::get('/buscar', 'EmbarqueController@search')->name('buscar.show');
Route::get('/buscarEmbarque', 'EmbarqueController@searchEmbarque')->name('buscarEmbarques.show');


// Route::resource('embarques', 'EmbarqueController');

Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');


// User
Route::get('/register', 'RegisterController@create')->name('register.create');
Route::post('/register', 'RegisterController@store')->name('register.store');

Auth::routes(['register' => false]);

// Asistencias
Route::get('/asistencias', 'AsistenciaController@index')->name('asistencia.index');
Route::get('/asistencias/create', 'AsistenciaController@create')->name('asistencia.create');
Route::post('/asistencias/store', 'AsistenciaController@store')->name('asistencia.store');
Route::get('/asistencias/{asistencia}', 'AsistenciaController@show')->name('asistencia.show');

// KPIs




Route::get('storage-link', function () {
    if (file_exists(public_path('storage'))) {
        return 'The "public/storage" directory already exists.';
    }
    app('files')->link(
        storage_path('app/public'),
        public_path('storage')
    );
    return 'The [public/storage] directory has been linked';
});

