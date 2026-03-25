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
    Route::get('SubKriteri-{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
    Route::post('SubKriteria/', [SubKriteriaController::class, 'store'])->name('subKriteria.store');
    Route::put('SubKriteria-{id}', [SubKriteriaController::class, 'update'])->name('subKriteria.update');
    Route::delete('SubKriteria-{id}', [SubKriteriaController::class, 'destroy'])->name('subKriteria.destroy');

});

Route::middleware(['auth', 'role:pelamar'])->group(function () {
    Route::get('/dashboard-pelamar', [UsersDashboardController::class, 'index']);
    Route::post('/pendaftaran', [UsersPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::resource('/pelamar', UsersPelamarController::class)->except(['create', 'show', 'edit']);
    Route::get('/syarat', [UsersPelamarController::class, 'syarat'])->name('pelamar.syarat');

});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});