<?php

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

Route::get('/', 'LoginController@form')->name('login');

Route::post('/login', 'LoginController@login');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->action('LoginController@form');
    })->name('logout');

    Route::get('/usuario/add', 'UsuarioController@create')->name('usuario-add');
    Route::post('/usuario/add', 'UsuarioController@store');
    Route::get('/usuario/edit/{id}', 'UsuarioController@edit');
    Route::get('/usuario/del/{id}', 'UsuarioController@destroy');


    Route::get('/conta/add', 'ContaController@create')->name('conta-add');
    Route::post('/conta/add', 'ContaController@store');
    Route::get('/conta/edit/{id}', 'ContaController@edit');
    Route::get('/conta/del/{id}', 'ContaController@destroy');

});