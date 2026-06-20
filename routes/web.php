<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KodeItemController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MutasiStokController;

// 1. ZONA PUBLIK
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. RUTE AUTENTIKASI — hanya buat yang BELUM login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// Logout
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. ZONA PEMBELI (wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/checkout/{item}', [PembelianController::class, 'create'])->name('checkout.create');
    Route::post('/checkout/{item}', [PembelianController::class, 'store'])->name('checkout.store');
    Route::get('/struk/{transaksi}', [PembelianController::class, 'struk'])->name('struk.show');
    Route::get('/pesanan-saya', [PembelianController::class, 'riwayat'])->name('pesanan.index');
});

// 4. ZONA RAHASIA (Back-Office)
Route::middleware(['auth', 'verified', 'role:admin,pegawai'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('items', ItemController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/mutasi-stok', [MutasiStokController::class, 'index']);
    Route::resource('kode-items', KodeItemController::class);
});

require __DIR__.'/settings.php';