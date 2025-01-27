<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\SumberPemasukan;
use Illuminate\Http\Request;
use App\Exports\PemasukanExport;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    /**
     * Menampilkan daftar semua pemasukan.
     */
    public function index()
    {
        $pemasukan = Pemasukan::with('sumberPemasukan')->get(); // Mengambil semua data pemasukan beserta sumbernya
        return view('pemasukan.index', compact('pemasukan'));
    }

    /**
     * Menampilkan form untuk menambahkan pemasukan baru.
     */
    public function create()
{
    $sumberPemasukan = SumberPemasukan::all(); // Ambil data sumber pemasukan
    return view('pemasukan.create', compact('sumberPemasukan'));
}


    /**
     * Menyimpan data pemasukan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_pemasukan' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'id_sumber_pemasukan' => 'required|exists:sumber_pemasukans,id',
        ]);

        // Simpan ke database
        Pemasukan::create($request->all());

        // Redirect ke halaman daftar pemasukan dengan pesan sukses
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data pemasukan.
     */
    public function show($id)
    {
        $pemasukan = Pemasukan::with('sumberPemasukan')->findOrFail($id); // Cari pemasukan berdasarkan ID dan relasi sumber
        return view('pemasukan.show', compact('pemasukan'));
    }

    /**
     * Menampilkan form untuk mengedit data pemasukan.
     */
    public function edit($id)
    {
        $pemasukan = Pemasukan::findOrFail($id); // Cari pemasukan berdasarkan ID
        $sumberPemasukan = SumberPemasukan::all(); // Mengambil semua data sumber pemasukan untuk dropdown
        return view('pemasukan.edit', compact('pemasukan', 'sumberPemasukan'));
    }

    /**
     * Memperbarui data pemasukan di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tgl_pemasukan' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'id_sumber_pemasukan' => 'required|exists:sumber_pemasukans,id',
        ]);

        // Cari pemasukan dan update datanya
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($request->all());

        // Redirect ke halaman daftar pemasukan dengan pesan sukses
        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    /**
     * Menghapus data pemasukan dari database.
     */
    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id); // Cari pemasukan berdasarkan ID
        $pemasukan->delete(); // Hapus data

        // Redirect ke halaman daftar pemasukan dengan pesan sukses
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil dihapus.');
    }

    public function exportPemasukan()
    {
    return Excel::download(new PemasukanExport, 'Data_Pemasukan.xlsx');
    }
}
