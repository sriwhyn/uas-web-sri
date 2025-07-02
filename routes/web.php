<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Middleware\RoleAdmin;

/*
|--------------------------------------------------------------------------
| ROOT "/" - Redirect Otomatis Berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'rootRedirect'])->name('home');

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/beranda', [FrontController::class, 'index'])->name('beranda');
Route::get('/event/{id}', [FrontController::class, 'eventDetail'])->name('event.detail');
Route::post('/daftar', [FrontController::class, 'daftar'])->middleware('auth')->name('event.daftar');

/*
|--------------------------------------------------------------------------

|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (Hanya Bisa Diakses Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', RoleAdmin::class])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Kategori
    Route::resource('kategori', KategoriController::class);

    // CRUD Event
    Route::resource('event', EventController::class);

    // CRUD Pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    // Manajemen Pendaftaran
    Route::resource('pendaftaran', PendaftaranController::class)->only([
        'index', 'show', 'update', 'destroy'
    ]);
});
