<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\KriteriaController;
use App\Http\Controllers\admin\SubKriteriaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\users\DashboardController as UsersDashboardController;
use App\Http\Controllers\users\PelamarController as UsersPelamarController;
use App\Http\Controllers\users\PendaftaranController as UsersPendaftaranController;
use App\Http\Controllers\admin\PelamarController;
use App\Http\Controllers\admin\PendaftaranController;
use App\Http\Controllers\users\BerkasController;

//admin
use App\Http\Controllers\admin\PenilaianController;

// Route::get('/', function () {
//     return view('admin.dashboard.dashboard');
// });

Route::middleware(['guest'])->group(function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login.proses');
    Route::get('/register', [AuthController::class, 'show'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
    
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard-admin', [DashboardController::class, 'index']);
    Route::resource('/user', UserController::class);
    Route::resource('/kriteria', KriteriaController::class);
    Route::get('/data-pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
    Route::get('/status-pelamar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::put('/status-pelamar/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');

    Route::get('SubKriteri-{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
    Route::post('SubKriteria/', [SubKriteriaController::class, 'store'])->name('subKriteria.store');
    Route::put('SubKriteria-{id}', [SubKriteriaController::class, 'update'])->name('subKriteria.update');
    Route::delete('SubKriteria-{id}', [SubKriteriaController::class, 'destroy'])->name('subKriteria.destroy');

    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');


});

Route::middleware(['auth', 'role:pelamar'])->group(function () {
    Route::get('/dashboard-pelamar', [UsersDashboardController::class, 'index']);
    Route::post('/pendaftaran', [UsersPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::resource('/pelamar', UsersPelamarController::class)->except(['create', 'show', 'edit']);
    Route::get('/syarat', [UsersPelamarController::class, 'syarat'])->name('pelamar.syarat');
    Route::resource('berkas', BerkasController::class);
    Route::get('hasil-seleksi', [App\Http\Controllers\users\HasilSeleksiController::class, 'index'])->name('hasil-seleksi.index');

});



Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});