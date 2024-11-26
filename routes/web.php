<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\PengadaanController;



Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/satuan', [ViewController::class, 'satuan'])->name('satuan.index');
    Route::get('/satuan/create', [ViewController::class, 'satuanCreate'])->name('satuan.create');
    Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
    Route::get('/satuan/{id}/edit', [ViewController::class, 'satuanEdit'])->name('satuan.edit');
    Route::post('/satuan/{id}', [SatuanController::class, 'update'])->name('satuan.update');
    Route::delete('/satuan/{id}', [SatuanController::class, 'delete'])->name('satuan.delete');



    Route::get('/barang', [ViewController::class, 'barang'])->name('barang.index');
    Route::get('/barang/create', [ViewController::class, 'barangCreate'])->name('barang.create');
    Route::get('/barang/{id}/edit', [ViewController::class, 'barangEdit'])->name('barang.edit');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::post('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.delete');



    Route::get('/vendor', [ViewController::class, 'vendor'])->name('vendor.index');
    Route::get('/vendor/create', [ViewController::class, 'vendorCreate'])->name('vendor.create');
    Route::get('/vendor/{id}/edit', [ViewController::class, 'vendorEdit'])->name('vendor.edit');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::post('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');


    Route::get('/role', [ViewController::class, 'role'])->name('role.index');
    Route::get('/role/create', [ViewController::class, 'roleCreate'])->name('role.create');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [ViewController::class, 'roleEdit'])->name('role.edit');
    Route::post('/role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.delete');


    Route::get('/user', [ViewController::class, 'user'])->name('user.index');
    Route::get('/user/create', [ViewController::class, 'userCreate'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [ViewController::class, 'userEdit'])->name('user.edit');
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/pengadaan', [ViewController::class, 'pengadaan'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [ViewController::class, 'pengadaanCreate'])->name('pengadaan.create');
    Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/pengadaan/{id}/edit', [ViewController::class, 'pengadaanEdit'])->name('pengadaan.edit');
    Route::post('/pengadaan/{id}', [PengadaanController::class, 'update'])->name('pengadaan.update');
    Route::delete('/pengadaan/{id}', [PengadaanController::class, 'delete'])->name('pengadaan.delete');
});
