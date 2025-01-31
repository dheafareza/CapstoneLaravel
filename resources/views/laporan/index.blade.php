@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="container">
    <h1 class="mt-4">Laporan Keuangan</h1>

    <!-- Tabel Laporan Keuangan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Transaksi</th>
                            <th>Jumlah Total Uang</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Pemasukan</td>
                        <td>{{ $totalTransaksiMasuk }}</td>
                        <td>Rp. {{ number_format($jumlahMasuk, 0, ',', '.') }}</td>
                        <td>
                            <!-- Tombol Export Excel -->
                            <a href="{{ route('laporan.export-pemasukan') }}" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                            </a>
                            <!-- Tombol Export PDF -->
                            <a href="{{ url('/export-pemasukan-pdf') }}" class="btn btn-danger btn-md">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF
                            </a>
                        </td>
                    </tr>
                        <tr>
                            <td>Pengeluaran</td>
                            <td>{{ $totalTransaksiKeluar }}</td>
                            <td>Rp. {{ number_format($jumlahKeluar, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('laporan.export-pengeluaran') }}" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                                </a>
                                <a href="{{ url('/export-pengeluaran-pdf') }}" class="btn btn-danger btn-md">
                                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
