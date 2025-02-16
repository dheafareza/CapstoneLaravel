@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Pengeluaran</h1>

    <!-- Tampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Sumber Pengeluaran -->
    <div class="col-lg-5 col-md-6 mb-4 custom-width">
    <div class="card shadow mb-4">
        <div class="card-header">Sumber Pengeluaran</div>
        <div class="card-body">
            @foreach ($sumberPengeluaran as $sumber)
                <h4 class="h4">
                    {{ $sumber['nama'] }}
                    <span class="float-right">Rp. {{ number_format($sumber['total'], 0, ',', '.') }}</span>
                </h4>
                <div class="progress" style="height: 18px;">
                    <div class="progress-bar progress-bar-striped {{ $sumber['warna'] }}" role="progressbar" 
                        style="width: {{ $sumber['persentase'] }}%" 
                        aria-valuenow="{{ $sumber['persentase'] }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        <strong>{{ $sumber['jumlah_transaksi'] }} Kali</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.custom-width {
    width: 50%; 
    padding-bottom: 20px;
}
.card-body h4 {
    font-size: 14px;
    margin-bottom: 8px; /* Tambahkan jarak */
}
.progress {
    height: 18px;
    margin-top: 10px; /* Jarak ke elemen atas */
    margin-bottom: 10px; /* Jarak ke elemen bawah */
}
</style>

    <!-- Tombol Tambah Pengeluaran -->
    <div class="mb-3">
        <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary-i"><i class="bi bi-plus"> Pengeluaran</i></a>
    </div>
    <style>
    .btn-primary-i {
        background-color: rgb(28, 200, 138); 
        color: white;
        border: none;
        padding: 5px 13px; 
        border-radius: 5px; 
        font-size: 16px; 
        cursor: pointer; 
    }
    .btn-primary-i:hover {
        background-color: rgb(20, 170, 115);
        color: white;
    }
    .btn-primary-i i {
        font-style: normal;
        font-weight: bold;
    }
    </style>

    <!-- Tabel Daftar Pengeluaran -->
    <div class="col-lg-5 col-md-6 mb-4 custom-width-i">
        <div class="card shadow mb-4">
            <div class="card-header">Transaksi Keluar </div>
            <div class="card-body">
                <table class="table datatable table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Sumber</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengeluaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tgl_pengeluaran }}</td>
                                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $item->id_sumber_pengeluaran }}</td>
                                <td>
                                    <!-- Tombol Aksi -->
                                    <a href="{{ route('pengeluaran.show', $item->id) }}" class="btn btn-outline-primary">Detail</a>
                                    <a href="{{ route('pengeluaran.edit', $item->id) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data pengeluaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.custom-width-i {
    width: 80%; 
    padding-bottom: 20px;
}
</style>
@endsection
