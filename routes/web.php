<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.index');
});

Route::prefix('clientes')->group(function(){
    Route::get('/', 'ClientesController@list')->name('clientes.list');
    Route::get('add', 'ClientesController@add')->name('clientes.add');
    Route::post('add', 'ClientesController@addAction')->name('clientes.addaction');
    Route::get('edit/{id}', 'ClientesController@edit')->name('clientes.edit');
    Route::post('edit/{id}', 'ClientesController@editAction')->name('clientes.editaction');
    Route::delete('delete', 'ClientesController@delete')->name('clientes.del');
});

Route::prefix('ordens')->group(function(){
    Route::get('/','OrdemServicoController@list')->name('ordens.list');
    Route::get('add', 'OrdemServicoController@add')->name('ordens.add');
});
