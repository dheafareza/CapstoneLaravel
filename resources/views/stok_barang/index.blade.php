@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Stok Barang</h4>
                    <div>
                        <a href="{{ route('stok_barang.create') }}" class="btn btn-primary">Tambah Stok Barang</a>
                        <a href="{{ route('stok_barang.export') }}" class="btn btn-success">Export Excel</a>
                        <a href="{{ url('/export-stok-barang-pdf') }}" class="btn btn-danger btn-md">Export PDF</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Ukuran</th>
                                <th>Stok Awal</th>
                                <th>Jumlah Masuk</th>
                                <th>Jumlah Keluar</th>
                                <th>Total Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stokBarangs as $stokBarang)
                                <tr>
                                    <td>{{ $stokBarang->kode_barang }}</td>
                                    <td>{{ $stokBarang->nama_barang }}</td>
                                    <td>{{ $stokBarang->ukuran }}</td>
                                    <td>{{ $stokBarang->stok_awal }}</td>
                                    <td>{{ $stokBarang->jumlah_masuk }}</td>
                                    <td>{{ $stokBarang->jumlah_keluar }}</td>
                                    <td>{{ $stokBarang->total_stok }}</td>
                                    <td>
                                        <a href="{{ route('stok_barang.show', $stokBarang->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('stok_barang.edit', $stokBarang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('stok_barang.destroy', $stokBarang->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data stok barang tidak tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
