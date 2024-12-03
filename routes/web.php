<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\DetailPengadaanController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\PenjualanController;



Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('satuan', SatuanController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('pengadaan', PengadaanController::class);
    Route::resource('detailPengadaan', DetailPengadaanController::class);
    Route::resource('margin_penjualan', MarginPenjualanController::class);
    Route::resource('penjualan', PenjualanController::class);
});
