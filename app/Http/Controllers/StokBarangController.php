<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Illuminate\Http\Request;
use App\Exports\StokBarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class StokBarangController extends Controller
{
    /**
     * Tampilkan daftar stok barang.
     */
    public function index()
    {
        $stokBarangs = StokBarang::all(); 
        return view('stok_barang.index', compact('stokBarangs'));
    }

    /**
     * Tampilkan form untuk menambahkan stok barang baru.
     */
    public function create()
    {
        return view('stok_barang.create');
    }

    /**
     * Simpan data stok barang baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:225|unique:stok_barangs,kode_barang',
            'nama_barang' => 'required|string|max:225',
            'ukuran' => 'required|string|max:225',
            'stok_awal' => 'required|integer|min:0',
            'jumlah_masuk' => 'required|integer|min:0',
            'jumlah_keluar' => 'required|integer|min:0',
        ]);

        // Simpan data
        StokBarang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'ukuran' => $request->ukuran,
            'stok_awal' => $request->stok_awal,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'total_stok' => $request->stok_awal + $request->jumlah_masuk - $request->jumlah_keluar,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('stok_barang.index')->with('success', 'Stok barang berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail stok barang.
     */
    public function show($id)
    {
        $stokBarang = StokBarang::findOrFail($id); // Ambil data berdasarkan ID
        return view('stok_barang.show', compact('stokBarang'));
    }

    /**
     * Tampilkan form untuk mengedit stok barang.
     */
    public function edit($id)
    {
        $stokBarang = StokBarang::findOrFail($id); // Ambil data berdasarkan ID
        return view('stok_barang.edit', compact('stokBarang'));
    }

    /**
     * Perbarui data stok barang di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:225|unique:stok_barangs,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:225',
            'ukuran' => 'required|string|max:225',
            'stok_awal' => 'required|integer|min:0',
            'jumlah_masuk' => 'required|integer|min:0',
            'jumlah_keluar' => 'required|integer|min:0',
        ]);

        // Ambil data stok barang
        $stokBarang = StokBarang::findOrFail($id);

        // Update data
        $stokBarang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'ukuran' => $request->ukuran,
            'stok_awal' => $request->stok_awal,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => $request->jumlah_keluar,
            'total_stok' => $request->stok_awal + $request->jumlah_masuk - $request->jumlah_keluar,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('stok_barang.index')->with('success', 'Stok barang berhasil diperbarui.');
    }

    /**
     * Hapus data stok barang dari database.
     */
    public function destroy($id)
    {
        $stokBarang = StokBarang::findOrFail($id); // Ambil data berdasarkan ID
        $stokBarang->delete(); // Hapus data

        // Redirect dengan pesan sukses
        return redirect()->route('stok_barang.index')->with('success', 'Stok barang berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new StokBarangExport, 'stok_barang.xlsx');
    }

    public function exportStokBarangPDF()
{
    $stok_barang = StokBarang::all();
    
    $pdf = Pdf::loadView('exports.stok_barang', compact('stok_barang'));

    return $pdf->download('Data_Stok_Barang.pdf');
}
}
