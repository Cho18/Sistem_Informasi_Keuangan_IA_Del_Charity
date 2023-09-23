<?php

namespace App\Exports;

use App\Models\donator_donasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AjuanBeasiswaExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $ajuanbeasiswa;

    public function __construct(Collection $ajuanbeasiswa)
    {
        $this->ajuanbeasiswa = $ajuanbeasiswa;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Donasi');
                $event->sheet->setCellValue('B' . ($highestRow + 1), $this->calculateTotalAjuanBeasiswa($this->ajuanbeasiswa));
                $event->sheet->getStyle('A' . ($highestRow + 1) . ':' . $lastColumn . ($highestRow + 1))->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn);

                $event->sheet->mergeCellsByColumnAndRow(3, $highestRow + 1, $lastColumnIndex, $highestRow + 1);
                $event->sheet->getStyleByColumnAndRow(3, $highestRow + 1, $lastColumnIndex, $highestRow + 1)->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->ajuanbeasiswa;

        $collection = new Collection();

        $collection->push([
            'Daftar Ajuan Beasiswa Saya',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                => 'No',
            'Total Bursar'                      => 'Total Bursar',
            'Semester'                          => 'Semester',
            'Deskripsi'                         => 'Deskripsi',
            'Status'                            => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                            => $index + 1,
                'Total Bursar'                  => $item->total_bursar,
                'Semester'                      => $item->semester,
                'Deskripsi'                     => strip_tags($item->deskripsi),
                'Status'                        => $item->status,
            ]);
        }

        return $collection;
    }

    private function calculateTotalAjuanBeasiswa(Collection $ajuanbeasiswa): float
    {
        $totalajuanbeasiswa = 0;

        foreach ($ajuanbeasiswa as $item) {
            $totalajuanbeasiswa += $item->total_bursar;
        }

        return $totalajuanbeasiswa;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1:E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->ajuanbeasiswa) + 2;
        $borderRange = 'A2:E' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:E1' => ['font' => ['bold' => true]],
            'A2:E2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Ajuan Beasiswa Saya';
    }
}
