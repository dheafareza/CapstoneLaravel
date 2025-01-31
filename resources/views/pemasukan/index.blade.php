@extends('layouts.app')

@section('title', 'Pemasukan')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Pemasukan</h1>

    <!-- Tampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Sumber Pendapatan -->
<div class="col-lg-5 col-md-6 mb-4 custom-width">
    <div class="card shadow mb-4">
        <div class="card-header">Sumber Pendapatan
            <!-- <h5-i class="card-title">Sumber Pendapatan</h5-i> -->
        </div>
        <div class="card-body">
            @foreach ($sumberPemasukan as $sumber)
                <h4 class="h4">
                    {{ $sumber['nama'] }}
                    <span class="float-right">Rp. {{ number_format($sumber['total'], 0, ',', '.') }}</span>
                </h4>
                <div class="progress mt-3" style="height: 20px;">
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
</style>


    <!-- Tombol Tambah Pemasukan -->
    <div class="mb-3">
        <a href="{{ route('pemasukan.create') }}" class="btn btn-primary-i"><i class="bi bi-plus"> Pemasukan</i></a>
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

    <!-- Tabel Daftar Pemasukan -->
    <div class="col-lg-5 col-md-6 mb-4 custom-width-i">
    <div class="card shadow mb-4">
    <div class="card-header">Transaksi Masuk </div>
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
                    @forelse ($pemasukan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tgl_pemasukan }}</td>
                            <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $item->id_sumber_pemasukan }}</td>
                            <td>
                                <!-- Tombol Aksi -->
                                <a href="{{ route('pemasukan.show', $item->id) }}" class="btn btn-outline-primary">Detail</a>
                                <a href="{{ route('pemasukan.edit', $item->id) }}" class="btn btn-outline-warning">Edit</a>
                                <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pemasukan.</td>
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
