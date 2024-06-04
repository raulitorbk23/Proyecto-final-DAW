<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/registrarse',[userController::class, 'registro'] )->name('user.registro');
Route::post('/registrarse',[userController::class, 'store'] )->name('user.store');

Route::get('/login',fn() => view('login2') )->name('user.index');
Route::post('/login',[userController::class, 'login'] )->name('user.login');

Route::get('/tienda',[ProductoController::class, 'index'])->name('tienda');

##Menú de secciones de la tienda
Route::get('/tienda/suplementos',[TiendaController::class, 'suplementos'])->name('tienda.suplementos');
Route::get('/tienda/ropa',[TiendaController::class, 'ropa'])->name('tienda.ropa');
Route::get('/tienda/accesorios',[TiendaController::class, 'accesorios'])->name('tienda.accesorios');
Route::get('/tienda/calzado',[TiendaController::class, 'calzado'])->name('tienda.calzado');
Route::get('/tienda/ofertas',[TiendaController::class, 'ofertas'])->name('tienda.ofertas');
Route::get('/tienda/novedades',[TiendaController::class, 'novedades'])->name('tienda.novedades');

Route::post('/tienda/guardar-en-carrito',[TiendaController::class, 'añadirProductoCarrito'])->name('tienda.carrito.añadirProducto');

Route::post('/store', [SessionController::class, 'storeData']);
Route::post('/actualizar-cantidad', [SessionController::class, 'actualizarCantidad']);
Route::get('/get', [SessionController::class, 'getData']);
Route::delete('/delete', [SessionController::class, 'deleteData']);

Route::get('/pagar', [TiendaController::class, 'pagar'])->name('pagar');

