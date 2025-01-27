<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    /**
     * Menampilkan daftar semua hutang.
     */
    public function index()
    {
        $hutang = Hutang::all(); // Mengambil semua data hutang
        return view('hutang.index', compact('hutang'));
    }

    /**
     * Menampilkan form untuk menambahkan hutang baru.
     */
    public function create()
    {
        return view('hutang.create');
    }

    /**
     * Menyimpan data hutang baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'tgl_hutang' => 'required|date',
            'alasan' => 'required|string',
            'penghutang' => 'required|string|max:40',
        ]);

        // Simpan ke database
        Hutang::create($request->all());

        // Redirect ke halaman daftar hutang dengan pesan sukses
        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data hutang.
     */
    public function show($id)
    {
        $hutang = Hutang::findOrFail($id); // Cari hutang berdasarkan ID
        return view('hutang.show', compact('hutang'));
    }

    /**
     * Menampilkan form untuk mengedit data hutang.
     */
    public function edit($id)
    {
        $hutang = Hutang::findOrFail($id); // Cari hutang berdasarkan ID
        return view('hutang.edit', compact('hutang'));
    }

    /**
     * Memperbarui data hutang di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'tgl_hutang' => 'required|date',
            'alasan' => 'required|string',
            'penghutang' => 'required|string|max:40',
        ]);

        // Cari hutang dan update datanya
        $hutang = Hutang::findOrFail($id);
        $hutang->update($request->all());

        // Redirect ke halaman daftar hutang dengan pesan sukses
        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diperbarui.');
    }

    /**
     * Menghapus data hutang dari database.
     */
    public function destroy($id)
    {
        $hutang = Hutang::findOrFail($id); // Cari hutang berdasarkan ID
        $hutang->delete(); 

        // Redirect ke halaman daftar hutang dengan pesan sukses
        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil dihapus.');
    }
}
