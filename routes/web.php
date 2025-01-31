<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StokBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PemasukanController;
use App\Exports\PemasukanPDFExport;
use App\Exports\PengeluaranPDFExport;
use App\Exports\StokBarangPDFExport;
use App\Exports\StokBarangExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\LoginController;

// Route untuk Dashboard
Route::get('/', function () {
    return view('master');
})->middleware('auth');

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

// Route resource untuk Stok Barang
Route::resource('stok_barang', StokBarangController::class);
// Route untuk Laporan Excel Stok Barang
Route::get('/stok-barang/export', [StokBarangController::class, 'export'])->name('stok_barang.export');

// Route untuk Export PDF Laporan
Route::get('/export-pemasukan-pdf', function () {
    $exporter = new PemasukanPDFExport();
    return $exporter->download();
})->name('laporan.export-pemasukan-pdf');

Route::get('/export-pengeluaran-pdf', function () {
    $exporter = new PengeluaranPDFExport();
    return $exporter->download();
});

// Route untuk Export PDF Laporan Stok Barang
Route::get('/export-stok-barang-pdf', function () {
    $exporter = new StokBarangPDFExport();
    return $exporter->download();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');