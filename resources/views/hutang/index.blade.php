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

    <!-- Row untuk Tabel dan Grafik -->
    <div class="row">
        <!-- Tabel Daftar Hutang (KIRI) -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">Daftar Hutang</div>
                <div class="card-body">
                    <table class="table datatable table-bordered table-hover">
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
                                        <a href="{{ route('hutang.show', $item->id_hutang) }}" class="btn btn-info btn-sm">Detail</a>
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
            </div>
        </div>

        <!-- Grafik Perbandingan Keuangan (KANAN) -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body pb-0">
                    <h5 class="card-title">Perbandingan Keuangan</h5>
                    <div id="comparisonChart" style="min-height: 400px;" class="echart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof echarts !== 'undefined') {
            var chart = echarts.init(document.querySelector("#comparisonChart"));
            chart.setOption({
                tooltip: { trigger: 'item' },
                legend: { top: '5%', left: 'center' },
                color: ['rgb(46, 202, 106)', 'rgb(220, 53, 69)'],
                series: [{
                    name: 'Perbandingan Keuangan',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: { show: false, position: 'center' },
                    emphasis: {
                        label: { show: true, fontSize: '18', fontWeight: 'bold' }
                    },
                    labelLine: { show: false },
                    data: [
                        { value: @json($jumlahmasuk), name: 'Pendapatan' },
                        { value: @json($jumlahkeluar), name: 'Pengeluaran' }
                    ]
                }]
            });
        } else {
            console.error("ECharts library not loaded.");
        }
    });
</script>

<style>
    .col-lg-8, .col-lg-4 {
        padding-bottom: 20px;
    }
</style>
@endsection
