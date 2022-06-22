<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterSheet;

class TransaksiExport implements WithEvents, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */



    function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 3,
            'B' => 6,
            'C' => 15,
            'D' => 30,
            'E' => 30,
            'F' => 25,
            'G' => 15,
            'H' => 25,
            // 'I' => 20,
            // 'J' => 15,
            // 'K' => 18,
            // 'L' => 30,
        ];
    }
    public function registerEvents(): array
    {
        $styleTitle = [
            'font' => [
                'bold' => true,
                'size' => 12
            ],
        ];
        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 12
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,

                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $styleData = [
            'font' => [
                'bold' => false,
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                ],
            ],

        ];
        return [
            AfterSheet::class => function (AfterSheet $event) use ($styleTitle, $styleData, $styleColumn) {
                $event->sheet->setCellValue('A1', 'Azyc Nomerator')->getStyle('A1')->applyFromArray($styleTitle);
                $event->sheet->setCellValue('A2', '(Alamat)');

                $event->sheet->setCellValue('A4', 'Laporan Transaksi')->getStyle('A4')->applyFromArray($styleTitle);


                //Kolom
                $event->sheet->setCellValue('B6', 'NO')->getStyle('B6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('C6', 'Tanggal')->getStyle('C6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('D6', 'User')->getStyle('D6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('E6', 'Total Bayar')->getStyle('E6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('F6', 'Status')->getStyle('F6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('G6', 'Alamat')->getStyle('G6')->applyFromArray($styleColumn);
                $event->sheet->setCellValue('H6', 'No Hp')->getStyle('H6')->applyFromArray($styleColumn);

                $datas = Transaksi::getData($this->from_date, $this->to_date);
                $cell = 7;
                $i = 1;
                foreach ($datas as $data) {
                    $event->sheet->getStyle('B' . $cell . ':' . 'H' . $cell)->applyFromArray($styleData);
                    $event->sheet->setCellValue('B' . $cell, $i);
                    $event->sheet->setCellValue('C' . $cell, $data->created_at);
                    $event->sheet->setCellValue('D' . $cell, $data->user_name);
                    $event->sheet->setCellValue('E' . $cell, $data->paid_total);
                    $event->sheet->setCellValue('F' . $cell, $data->status);
                    $event->sheet->setCellValue('G' . $cell, $data->address);
                    $event->sheet->setCellValue('H' . $cell, $data->no_hp);
                    $i++;
                    $cell++;
                }
            }
        ];
    }
    // public function collection()
    // {
    //     return Transaksi::all();
    // }
}
