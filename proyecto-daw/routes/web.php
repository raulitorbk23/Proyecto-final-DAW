<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\userController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/registrarse',[userController::class, 'registro'] )->name('user.registro');
Route::post('/registrarse',[userController::class, 'store'] )->name('user.store');

Route::get('/login',fn() => view('login2') )->name('login');
Route::post('/login',[userController::class, 'login'] )->name('user.login');

Route::get('/contacto',fn() => view('contacto') )->name('contacto');


## TIENDA

Route::get('/tienda',[TiendaController::class, 'index'])->name('tienda');

## CATEGORIAS DE LA TIENDA

Route::get('/tienda/suplementos',[TiendaController::class, 'suplementos'])->name('tienda.suplementos');
Route::get('/tienda/ropa',[TiendaController::class, 'ropa'])->name('tienda.ropa');
Route::get('/tienda/accesorios',[TiendaController::class, 'accesorios'])->name('tienda.accesorios');
Route::get('/tienda/calzado',[TiendaController::class, 'calzado'])->name('tienda.calzado');
Route::get('/tienda/ofertas',[TiendaController::class, 'ofertas'])->name('tienda.ofertas');
Route::get('/tienda/novedades',[TiendaController::class, 'novedades'])->name('tienda.novedades');

Route::post('/tienda/guardar-en-carrito',[TiendaController::class, 'añadirProductoCarrito'])->name('tienda.carrito.añadirProducto');

## PÁGINA INDIVIDUAL DE CADA PRODUCTO

Route::get('/tienda/{producto}',[ProductoController::class, 'show'])->name('tienda.show');




## COOKIES
Route::post('/store', [SessionController::class, 'storeData']);
Route::post('/actualizar-cantidad', [SessionController::class, 'actualizarCantidad']);
Route::get('/get', [SessionController::class, 'getData']);
Route::delete('/delete', [SessionController::class, 'deleteData']);

Route::get('/pagar/carrito', [PagoController::class, 'index'])->middleware('auth')->name('pagar.carrito');
Route::post('/pagar',[PagoController::class, 'store'])->middleware('auth')->name('pagar');
Route::get('/pedido/{id_pedido}', [PagoController::class, 'detalles'])->name('pagar.detallesPedido');



## DASHBOARD

Route::get('/panel-admin', [UsuarioController::class, 'index'])->name('admin');

#### DASHBOARD USUARIOS

Route::get('/panel-admin/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('usuario/datos/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::post('/panel-admin/usuario',[UsuarioController::class, 'store'])->name('usuario.create');
Route::get('/usuario/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{usuario_id}', [UsuarioController::class, 'destroy'])->name('usuario.delete');

#### DASHBOARD PRODUCTOS

Route::get('/panel-admin/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::post('/panel-admin/producto',[ProductoController::class, 'store'])->name('producto.create');
Route::get('/producto/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
Route::get('/producto/obtener-subcategorias/{producto}', [ProductoController::class, 'obtenerSubcategorias'])->name('producto.edit.obtenerSubcategoria');
Route::put('/producto/{producto}', [ProductoController::class, 'update'])->name('producto.update');
Route::post('/producto/update-stock', [ProductoController::class, 'updateStock'])->name('producto.updateStock');
Route::delete('/producto/{producto_id}', [ProductoController::class, 'destroy'])->name('producto.delete');

#### DASHBOARD PEDIDOS

Route::get('/panel-admin/pedido', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/pedido/datos/{pedido}', [PedidoController::class, 'show'])->name('pedido.show');
Route::post('/panel-admin/pedido',[PedidoController::class, 'store'])->name('pedido.create');
Route::get('/pedido/{pedido}/edit', [PedidoController::class, 'edit'])->name('pedido.edit');
Route::put('/pedido/{pedido}', [PedidoController::class, 'update'])->name('pedido.update');
Route::delete('/pedido/{pedido_id}', [PedidoController::class, 'destroy'])->name('pedido.delete');