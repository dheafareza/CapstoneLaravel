<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PengeluaranExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    /**
     * Ambil data yang akan diexport.
     */
    public function collection()
    {
        return Pengeluaran::select('id','tgl_pengeluaran', 'jumlah', 'id_sumber_pengeluaran')->get();
    }

    /**
     * Tambahkan header di file Excel.
     */
    public function headings(): array
    {
        return ['ID Pengeluaran', 'Tgl Pengeluaran', 'Jumlah', 'ID Sumber'];
    }

    /**
     * Tambahkan gaya pada file Excel.
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FF4CAF50'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A1:D100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        foreach (range('A', 'D') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    public function title(): string
    {
        return 'Data Pengeluaran';
    }
}
