@extends('layouts.app')

@section('title', 'Tambah Stok Barang')

@section('content')
<div class="container">
    <h1 class="mt-4">Tambah Stok Barang</h1>

    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stok_barang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok_awal" class="form-label">Stok Awal</label>
            <input type="number" class="form-control" id="stok_awal" name="stok_awal" value="{{ old('stok_awal') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
            <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk" value="{{ old('jumlah_masuk') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
            <input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar" value="{{ old('jumlah_keluar') }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
