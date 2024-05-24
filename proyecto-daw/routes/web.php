<?php

use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrarse',[userController::class, 'registro'] )->name('user.registro');
Route::post('/registrarse',[userController::class, 'store'] )->name('user.store');

Route::get('/login',fn() => view('login2') )->name('user.index');
Route::post('/login',[userController::class, 'login'] )->name('user.login');
