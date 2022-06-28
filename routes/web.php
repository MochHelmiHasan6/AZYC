<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\ProduksController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified', 'can:admin'])->group(function () {
    Route::prefix('admin-page')->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('/transaksi/report', [TransaksiController::class, 'report'])->name('transaksi.report');
        Route::resources([
            'dashboard' => DashboardController::class,
            'user' => UserController::class,
            'produk' => ProdukController::class,
            'transaksi' => TransaksiController::class,
        ]);
    });
});

Route::middleware(['auth:sanctum', 'verified', 'can:user'])->group(function () {
    Route::get('/beranda', [ProduksController::class, 'index'])->name('pengguna.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/detail-jasa/{id}', [ProduksController::class, 'detail'])->name('detail-jasa');
    Route::post('/updateQtyCart', [CartDetailController::class, 'updateQtyCart'])->name('updateQtyCart');
    Route::get('pembayaran/{reference}', [CartController::class, 'detailPembayaran'])->name('detailpembayaran');
    Route::resource('cart', CartController::class);
    Route::post('/kosongkan/{id}', [CartController::class, 'kosongkan'])->name('kosongkan');
    Route::get('/checkout/{id}', [CartController::class, 'checkout'])->name('checkout');
    // cart detail
    Route::resource('cartdetail', CartDetailController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
