<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanMahasiswaController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use App\Models\KategoriTransaksi;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');
Route::resource('user', UserController::class);

Route::resource('kategori-transaksi', KategoriTransaksiController::class);
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('jurusan-mahasiswa', JurusanMahasiswaController::class);
