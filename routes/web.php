<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DisplayController;


Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [DisplayController::class, 'index'])->name('welcome');
Route::get('/hari/{hari}', [DisplayController::class, 'showDay'])->name('jadwal.hari');

// Route untuk CRUD Data Master
Route::resource('guru', GuruController::class);
Route::resource('mapel', MapelController::class);
Route::resource('ruangan', RuanganController::class);

// Jadwal per hari
Route::get('jadwal/{hari}', [JadwalController::class, 'index'])->name('jadwal.hari');
Route::get('jadwal/{hari}/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('jadwal/{hari}', [JadwalController::class, 'store'])->name('jadwal.store');
Route::get('jadwal/{hari}/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::put('jadwal/{hari}/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('jadwal/{hari}/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
