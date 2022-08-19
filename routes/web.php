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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth:web'], function () {
    Route::resource('categoria', \App\Http\Controllers\CategoriaController::class);
    Route::resource('rol', \App\Http\Controllers\RolController::class);
    Route::resource('tipo-documento', \App\Http\Controllers\TipoDocumentoController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('talla', \App\Http\Controllers\TallaController::class);
    Route::resource('producto', \App\Http\Controllers\ProductoController::class);
    Route::resource('detalle-facturas', \App\Http\Controllers\DetalleFacturaController::class);
    Route::resource('factura', \App\Http\Controllers\FacturaController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/user/search/params', [\App\Http\Controllers\UserController::class, 'search'])->name('search_user');
    Route::get('/user/update/password', [\App\Http\Controllers\UserController::class, 'update_password'])->name('update_password');
    Route::post('/user/update/password', [\App\Http\Controllers\UserController::class, 'update_password_action'])->name('update_password_form');
    Route::post('/producto/search/categoria', [\App\Http\Controllers\ProductoController::class, 'search'])->name('search_product');
});
