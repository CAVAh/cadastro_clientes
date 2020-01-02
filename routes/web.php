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

function createDefaultRoutes($prefix, $controller = null)
{
    if ($controller) {
        if (strpos($controller, '@') === false) {
            $c = $controller . '@';
        } else {
            $c = $controller;
        }
    } else {
        $c = str_replace('_', '', ucwords($prefix, '_')) . 'Controller@';
    }

    Route::get('/', ['as' => 'index', 'uses' => $c . 'index']);
    Route::post('/', ['as' => 'store', 'uses' => $c . 'store']);
    Route::get('/create', ['as' => 'create', 'uses' => $c . 'create']);
    Route::get('/{' . $prefix . '}/edit', ['as' => 'edit', 'uses' => $c . 'edit']);
    Route::put('/{' . $prefix . '}', ['as' => 'update', 'uses' => $c . 'update']);
    Route::delete('/{' . $prefix . '}', ['as' => 'destroy', 'uses' => $c . 'destroy']);
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/roles-permissions', 'HomeController@rolesPermissions');

$prefixs = ['pais', 'estado', 'categoria', 'quarto', 'cidade', 'portador', 'tipo_hospedagem', 'profissao', 'bairro', 'grupo_hospedagem', 'cliente'];

foreach ($prefixs as $prefix) {
    Route::group(['prefix' => $prefix, 'as' => $prefix . '.'], function () use ($prefix) {
        createDefaultRoutes($prefix);
    });
}
