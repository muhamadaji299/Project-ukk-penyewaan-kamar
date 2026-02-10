<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservasiPelangganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReservasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/reservasi',[ReservasiPelangganController::class, 'index'])->name('reservasi.index');
Route::get('/reservasi/create/{id_kamar}', [ReservasiPelangganController::class, 'create'])
     ->name('reservasi.create');
Route::post('/reservasi/store',[ReservasiPelangganController::class, 'store'])->name('reservasi.store');


Route::middleware('admin')->group(function () {

 Route::get('/admin/reservasi', [AdminReservasiController::class, 'index'])
        ->name('admin.reservasi.index');

    Route::put('/admin/reservasi/{id}', [AdminReservasiController::class, 'updateStatus'])
        ->name('admin.reservasi.update');
Route::resource('/admin',AdminController::class);
  
});
