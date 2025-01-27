@extends('layouts.app')

@section('title', 'Daftar Hutang')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Hutang</h1>

    <!-- Tampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Hutang -->
    <div class="mb-3">
        <a href="{{ route('hutang.create') }}" class="btn btn-primary">Tambah Hutang</a>
    </div>

    <!-- Tabel Daftar Hutang -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Penghutang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hutang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $item->tgl_hutang }}</td>
                    <td>{{ $item->alasan }}</td>
                    <td>{{ $item->penghutang }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <a href="{{ route('hutang.show', $item->id_hutang) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('hutang.edit', $item->id_hutang) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('hutang.destroy', $item->id_hutang) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data hutang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
