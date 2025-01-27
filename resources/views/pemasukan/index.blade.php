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

    <!-- Tombol Tambah Pemasukan -->
    <div class="mb-3">
        <a href="{{ route('pemasukan.create') }}" class="btn btn-primary">Tambah Pemasukan</a>
    </div>

    <!-- Tabel Daftar Pemasukan -->
    <table class="table table-bordered">
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
                        <a href="{{ route('pemasukan.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('pemasukan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
@endsection
