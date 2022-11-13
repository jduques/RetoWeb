<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PacienteController;

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

Route::get('/', function () { return Redirect::to('index'); });

Route::get('/index', 'App\Http\Controllers\PacienteController@index')->name('indexPacientes');
Route::get('/create', 'App\Http\Controllers\PacienteController@create')->name('crearPaciente');
Route::get('/destroy/{id}', 'App\Http\Controllers\PacienteController@destroy')->name('destroyPaciente');
Route::get('/edit/{id}', 'App\Http\Controllers\PacienteController@edit')->name('editPaciente');
Route::put('/update/{id}', 'App\Http\Controllers\PacienteController@update')->name('updatePaciente');


