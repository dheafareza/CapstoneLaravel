<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Exports\PemasukanExport;
use App\Exports\PengeluaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::all();
        $pengeluaran = Pengeluaran::all();

        $jumlahMasuk = $pemasukan->sum('jumlah');
        $jumlahKeluar = $pengeluaran->sum('jumlah');

        $totalTransaksiMasuk = $pemasukan->count();
        $totalTransaksiKeluar = $pengeluaran->count();

        return view('laporan.index', compact(
            'pemasukan',
            'pengeluaran',
            'jumlahMasuk',
            'jumlahKeluar',
            'totalTransaksiMasuk',
            'totalTransaksiKeluar'
        ));
    }

    public function exportPemasukan()
{
    return Excel::download(new PemasukanExport, 'Data_Pemasukan.xlsx');
}

public function exportPengeluaran()
{
    return Excel::download(new PengeluaranExport, 'Data_Pengeluaran.xlsx');
}
}
