<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\PublicOrderController;
/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK / PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/menu', [PublicMenuController::class, 'index'])
    ->name('public.menu');

 Route::get('/menu/{id}', [PublicMenuController::class, 'show'])
    ->name('public.menu.detail');

Route::get('/menu/{id}/pesan', [
    PublicOrderController::class, 'create'
])->name('public.order.create');

Route::post('/pesanan', [
    PublicOrderController::class, 'store'
])->name('public.order.store');

Route::get('/pesanan/{id}/berhasil', [
    PublicOrderController::class, 'success'
])->name('public.order.success');

Route::get('/tes-blade', function () {
    return view('public.tes-blade');
});

/*
|--------------------------------------------------------------------------
| LOGIN DAN LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Kelola Menu Admin
    Route::get('/admin/menu', [MenuController::class, 'index'])
        ->name('admin.menu.index');

    Route::get('/admin/menu/create', [MenuController::class, 'create'])
        ->name('admin.menu.create');

    Route::post('/admin/menu', [MenuController::class, 'store'])
        ->name('admin.menu.store');

    Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])
        ->name('admin.menu.edit');

    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])
        ->name('admin.menu.update');

    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])
        ->name('admin.menu.destroy');

    // Pesanan dan Pembayaran
    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::get('/penjualan/create', [PenjualanController::class, 'create']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);
    Route::get('/penjualan/{id}/payment', [PenjualanController::class, 'payment']);
    Route::post('/penjualan/{id}/payment', [PenjualanController::class, 'storePayment']);

    // Pelanggan
    Route::get('/pelanggan', [PenjualanController::class, 'pelanggan']);

    // Laporan
    Route::get('/laporan', [PenjualanController::class, 'laporan']);

    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index']);
    Route::put('/pengaturan', [PengaturanController::class, 'update']);

    Route::post('/penjualan/{id}/status', [
    PenjualanController::class,
    'updateStatus'
])->name('penjualan.updateStatus');
});