<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/users', 'UserController@index')->name('usuarios.index');
Route::post('/user/post', 'UserController@store')->name('usuario.store');
Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
