<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\SumberPengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Menampilkan daftar semua pengeluaran.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::with('sumberPengeluaran')->get(); // Mengambil semua data pengeluaran beserta sumbernya
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Menampilkan form untuk menambahkan pengeluaran baru.
     */
    public function create()
    {
        $sumberPengeluaran = SumberPengeluaran::all(); // Mengambil semua data sumber pengeluaran untuk dropdown
        return view('pengeluaran.create', compact('sumberPengeluaran'));
    }

    /**
     * Menyimpan data pengeluaran baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_pengeluaran' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'id_sumber_pengeluaran' => 'required|exists:sumber_pengeluarans,id',
        ]);

        // Simpan ke database
        Pengeluaran::create($request->all());

        // Redirect ke halaman daftar pengeluaran dengan pesan sukses
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data pengeluaran.
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::with('sumberPengeluaran')->findOrFail($id); // Cari pengeluaran berdasarkan ID dan relasi sumber
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    /**
     * Menampilkan form untuk mengedit data pengeluaran.
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id); // Cari pengeluaran berdasarkan ID
        $sumberPengeluaran = SumberPengeluaran::all(); // Mengambil semua data sumber pengeluaran untuk dropdown
        return view('pengeluaran.edit', compact('pengeluaran', 'sumberPengeluaran'));
    }

    /**
     * Memperbarui data pengeluaran di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tgl_pengeluaran' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'id_sumber_pengeluaran' => 'required|exists:sumber_pengeluarans,id',
        ]);

        // Cari pengeluaran dan update datanya
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->all());

        // Redirect ke halaman daftar pengeluaran dengan pesan sukses
        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pengeluaran dari database.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id); // Cari pengeluaran berdasarkan ID
        $pengeluaran->delete(); // Hapus data

        // Redirect ke halaman daftar pengeluaran dengan pesan sukses
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
