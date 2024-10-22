<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SatuanController;



Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('barang', BarangController::class);
Route::resource('satuan', SatuanController::class);
