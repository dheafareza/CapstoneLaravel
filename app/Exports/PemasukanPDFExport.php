<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Dompdf\Dompdf;
use Dompdf\Options;

class PemasukanPDFExport
{
    public function download()
    {
        // Ambil data pemasukan
        $data = Pemasukan::select('id', 'tgl_pemasukan', 'jumlah', 'id_sumber_pemasukan')->get();

        // Render data ke view
        $html = view('exports.pemasukan', compact('data'))->render();

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Ukuran dan orientasi kertas
        $dompdf->render();

        // Unduh file PDF
        return $dompdf->stream('data_pemasukan.pdf', ['Attachment' => true]);
    }
}
