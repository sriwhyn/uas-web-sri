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

Route::get('/', [FrontController::class, 'rootRedirect'])->name('home');
Route::get('/beranda', [FrontController::class, 'index'])->name('beranda');

Route::get('/event/semua', [FrontController::class, 'eventSemua'])->name('event.semua');


Route::get('/event/{id}', [FrontController::class, 'eventDetail'])->name('event.detail');
 Route::get('/event/{id}/daftar', [FrontController::class, 'formDaftar'])->name('event.form.daftar');
Route::post('/daftar', [FrontController::class, 'daftar'])->middleware('auth')->name('event.daftar');


Route::get('/agenda', [FrontController::class, 'agenda'])->name('agenda');


Route::get('/pengumuman', [FrontController::class, 'pengumumanSemua'])->name('pengumuman.semua');
Route::get('/pengumuman/{id}', [FrontController::class, 'pengumumanDetail'])->name('pengumuman.detail');
Route::get('/pengumuman/suggest', [FrontController::class, 'suggestPengumuman'])->name('pengumuman.suggest');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::prefix('admin')->name('admin.')->middleware(['auth', RoleAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data/statistik', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    Route::resource('kategori', KategoriController::class);
    Route::resource('event', EventController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('pendaftaran', PendaftaranController::class)->only(['index', 'show', 'update', 'destroy']);
});
