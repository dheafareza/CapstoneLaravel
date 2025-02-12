@extends('layouts.app')

@section('title', 'Detail Stok Barang')

@section('content')
<div class="container">
    <h1 class="mt-4">Detail Stok Barang</h1>

    <div class="card">
        <div class="card-header">
            Informasi Stok Barang
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Kode Barang:</strong>
                <p>{{ $stokBarang->kode_barang }}</p>
            </div>
            <div class="mb-3">
                <strong>Nama Barang:</strong>
                <p>{{ $stokBarang->nama_barang }}</p>
            </div>
            <div class="mb-3">
                <strong>Ukuran:</strong>
                <p>{{ $stokBarang->ukuran }}</p>
            </div>
            <div class="mb-3">
                <strong>Stok Awal:</strong>
                <p>{{ number_format($stokBarang->stok_awal, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Jumlah Masuk:</strong>
                <p>{{ number_format($stokBarang->jumlah_masuk, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Jumlah Keluar:</strong>
                <p>{{ number_format($stokBarang->jumlah_keluar, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Stok Akhir:</strong>
                <p>{{ number_format($stokBarang->stok_awal + $stokBarang->jumlah_masuk - $stokBarang->jumlah_keluar, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('stok_barang.edit', $stokBarang->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Detail Stok Barang')

@section('content')
<div class="container">
    <h1 class="mt-4">Detail Stok Barang</h1>

    <div class="card">
        <div class="card-header">
            Informasi Stok Barang
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Kode Barang:</strong>
                <p>{{ $stokBarang->kode_barang }}</p>
            </div>
            <div class="mb-3">
                <strong>Nama Barang:</strong>
                <p>{{ $stokBarang->nama_barang }}</p>
            </div>
            <div class="mb-3">
                <strong>Ukuran:</strong>
                <p>{{ $stokBarang->ukuran }}</p>
            </div>
            <div class="mb-3">
                <strong>Stok Awal:</strong>
                <p>{{ number_format($stokBarang->stok_awal, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Jumlah Masuk:</strong>
                <p>{{ number_format($stokBarang->jumlah_masuk, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Jumlah Keluar:</strong>
                <p>{{ number_format($stokBarang->jumlah_keluar, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <strong>Stok Akhir:</strong>
                <p>{{ number_format($stokBarang->stok_awal + $stokBarang->jumlah_masuk - $stokBarang->jumlah_keluar, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('stok_barang.edit', $stokBarang->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
