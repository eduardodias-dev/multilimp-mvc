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
})->name('home')->middleware('auth');

Route::prefix('clientes')->middleware('auth')->group(function(){
    Route::get('/', 'ClientesController@list')->name('clientes.list');
    Route::get('add', 'ClientesController@add')->name('clientes.add');
    Route::post('add', 'ClientesController@addAction')->name('clientes.addaction');
    Route::get('edit/{id}', 'ClientesController@edit')->name('clientes.edit');
    Route::post('edit/{id}', 'ClientesController@editAction')->name('clientes.editaction');
    Route::delete('delete', 'ClientesController@delete')->name('clientes.del');
});

Route::prefix('ordens')->middleware('auth')->group(function(){
    Route::get('/','OrdemServicoController@list')->name('ordens.list');
    Route::get('add', 'OrdemServicoController@add')->name('ordens.add');
    Route::post('add', 'OrdemServicoController@addAction')->name('ordens.addaction');
    Route::get('edit/{id}', 'OrdemServicoController@edit')->name('ordens.edit');
    Route::post('edit/{id}', 'OrdemServicoController@editAction')->name('ordens.editaction');
    Route::delete('delete', 'OrdemServicoController@delete')->name('ordens.del');
    Route::get('getOrdemServicoPrint', 'OrdemServicoController@getOrdemServicoPrint')->name('ordens.getprint');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@saveRegistration')->name('saveregistration');
