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
Route::get('/novo', 'LoginController@create')->name('novo');
Route::post('/novo', 'LoginController@store');

Route::post('/login', 'LoginController@login');

Route::group(array('middleware' => ['auth']), function(){

    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->action('LoginController@form');
    })->name('logout');

    Route::get('/usuario/add', 'UsuarioController@create')->name('usuario-add');
    Route::post('/usuario/add', 'UsuarioController@store');
    Route::get('/usuario/edit/{id}', 'UsuarioController@edit')->name('usuario-edit');
    Route::get('/usuario/del/{id}', 'UsuarioController@destroy')->name('usuario-del');


    Route::get('/conta/add', 'ContaController@create')->name('conta-add');
    Route::post('/conta/add', 'ContaController@store');
    Route::get('/conta/edit/{id}', 'ContaController@edit')->name("conta-edit");
    Route::get('/conta/del/{id}', 'ContaController@destroy')->name("conta-del");

});

Route::group(array('prefix' => 'api', 'middleware' => 'cors'), function(){

    Route::get('/', function () {
      return response()->json(['message' => 'Fincob API', 'status' => 'Connected']);;
  });

  Route::post('/login','ApiLoginController@login');

});
