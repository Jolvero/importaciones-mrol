<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/users', 'UserController@index')->name('usuarios.index');
Route::post('/user/post', 'UserController@store')->name('usuario.store');
Route::put('/user/{user}/update', 'UserController@update')->name('usuario.update');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
