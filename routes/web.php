<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanMahasiswaController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\LaporanMahasiswaController;
use App\Http\Controllers\LaporanTransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware('guest')->group(function () {
    // Auth
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});




Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('kategori-transaksi', KategoriTransaksiController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('jurusan-mahasiswa', JurusanMahasiswaController::class);
    Route::resource('transaksi', TransaksiController::class);
    // table rekapitulasi
    Route::get('rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');
    Route::get('rekapitulasi/table', [RekapitulasiController::class, 'tableRekapitulasi'])->name('rekapitulasi.table');

    // Laporan
    Route::get('laporan-transaksi', [LaporanTransaksiController::class, 'index'])->name('laporan-transaksi.index');
    Route::post('laporan-transaksi/print-pdf', [LaporanTransaksiController::class, 'printPDF'])->name('laporan-transaksi.pdf');
    Route::post('laporan-transaksi/export', [LaporanTransaksiController::class, 'exportExcel'])->name('laporan-transaksi.export');
    Route::get('laporan-mahasiswa', [LaporanMahasiswaController::class, 'index'])->name('laporan-mahasiswa.index');
    Route::post('laporan-mahasiswa/print-pdf', [LaporanMahasiswaController::class, 'printPDF'])->name('laporan-mahasiswa.pdf');
    Route::post('laporan-mahasiswa/export', [LaporanMahasiswaController::class, 'exportExcel'])->name('laporan-mahasiswa.export');
});
