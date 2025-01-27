<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PemasukanController;

// Route untuk Dashboard
Route::get('/', function () {
    return view('master');
});

Route::get('/', [DashboardController::class, 'index']);

// Route resource untuk Karyawan
Route::resource('karyawan', KaryawanController::class);

// Route resource untuk Pemasukan
Route::resource('pemasukan', PemasukanController::class);

// Route resource untuk Pengeluaran
Route::resource('pengeluaran', PengeluaranController::class);

// Route resource untuk Hutang 
Route::resource('hutang', HutangController::class);

// Route untuk Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export-pemasukan', [LaporanController::class, 'exportPemasukan'])->name('laporan.export-pemasukan');
Route::get('/laporan/export-pengeluaran', [LaporanController::class, 'exportPengeluaran'])->name('laporan.export-pengeluaran');