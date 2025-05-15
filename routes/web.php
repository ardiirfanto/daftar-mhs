<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/processLogin', [AuthController::class, 'login'])->name('processLogin');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/processRegister', [AuthController::class, 'register'])->name('processRegister');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('mahasiswa')->group(function () {
            Route::get('/', [AdminMahasiswaController::class, 'index'])->name('admin.mahasiswa');
            Route::get('/show/{id}',[AdminMahasiswaController::class, 'show'])->name('admin.mahasiswa.show');
            Route::post('/update',[AdminMahasiswaController::class,'update'])->name('admin.mahasiswa.update');
        });
    });

    // Mahasiswa Routes
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
    });
});
