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
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DaftarAjuanBeasiswaExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $daftarajuanbeasiswa;

    public function __construct(Collection $daftarajuanbeasiswa)
    {
        $this->daftarajuanbeasiswa = $daftarajuanbeasiswa;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->mergeCells('A' . ($highestRow + 1) . ':B' . ($highestRow + 1));
                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Donasi');
                $event->sheet->setCellValue('C' . ($highestRow + 1), $this->calculateTotalDonasi($this->daftarajuanbeasiswa));
                $event->sheet->getStyle('A' . ($highestRow + 1) . ':' . $lastColumn . ($highestRow + 1))->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn);

                $event->sheet->mergeCellsByColumnAndRow(4, $highestRow + 1, $lastColumnIndex, $highestRow + 1);
                $event->sheet->getStyleByColumnAndRow(4, $highestRow + 1, $lastColumnIndex, $highestRow + 1)->applyFromArray([
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
            'F' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->daftarajuanbeasiswa;

        $collection = new Collection();

        $collection->push([
            'Daftar Ajuan Beasiswa Awardee',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                => 'No',
            'Nama Penerima Beasiswa'            => 'Nama Penerima Beasiswa',
            'Total Bursar'                      => 'Total Bursar',
            'Semester'                          => 'Semester',
            'Deskripsi'                         => 'Deskripsi',
            'Status'                            => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                            => $index + 1,
                'Nama Penerima Beasiswa'        => $item->penerima_beasiswa->name_awarde,
                'Total Bursar'                  => $item->total_bursar,
                'Semester'                      => $item->semester,
                'Deskripsi'                     => strip_tags($item->deskripsi),
                'Status'                        => $item->status,
            ]);
        }

        return $collection;
    }

    private function calculateTotalDonasi(Collection $daftarajuanbeasiswa): float
    {
        $totalbursar = 0;

        foreach ($daftarajuanbeasiswa as $item) {
            $totalbursar += $item->total_bursar;
        }

        return $totalbursar;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->daftarajuanbeasiswa) + 2;
        $borderRange = 'A2:F' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:F1' => ['font' => ['bold' => true]],
            'A2:F2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Ajuan Beasiswa Awardee';
    }
}
