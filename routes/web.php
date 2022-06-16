<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\ProduksController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function() { return view('auth.login'); });

Route::middleware(['auth:sanctum', 'verified', 'can:admin'])->group(function () {
    Route::prefix('admin-page')->group(function () {
        Route::get('/home', [UserController::class, 'index'])->name('admin.index');
        Route::resources([
            'user' => UserController::class,
            'produk' => ProdukController::class,
            'transaksi' => TransaksiController::class,
        ]);
    });
});

Route::middleware(['auth:sanctum', 'verified', 'can:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/beranda', [ProduksController::class, 'index'])->name('pengguna.index');
    Route::get('/detail-transaksi/{id}', [ProduksController::class, 'transaksi'])->name('transaksi');
    Route::resource('cart', CartController::class);
    Route::patch('kosongkan/{id}', 'CartController@kosongkan');
    // cart detail
    Route::resource('cartdetail', CartDetailController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
