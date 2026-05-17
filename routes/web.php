<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PaketGymController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\AlatGymController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    // Anggota
    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'anggota'
    ]);
    
    // Paket Gym
    Route::resource('paket-gym', PaketGymController::class);
    
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    
    // Presensi
    Route::resource('presensi', PresensiController::class);
    Route::post('/presensi/quick', [PresensiController::class, 'quickPresensi'])
        ->name('presensi.quick');
    
    // Alat Gym
    Route::resource('alat-gym', AlatGymController::class);
    
    // User Management (Admin only)
    Route::resource('user', UserController::class)->middleware('role:admin');
});