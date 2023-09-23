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
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InformasiDonasiExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $informasidonasi;

    public function __construct(Collection $informasidonasi)
    {
        $this->informasidonasi = $informasidonasi;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->mergeCells('A' . ($highestRow + 1) . ':B' . ($highestRow + 1));
                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Donasi Donator');
                $event->sheet->setCellValue('C' . ($highestRow + 1), "Rp " . number_format($this->calculateTotalDonasi($this->informasidonasi), 2, ',', '.'));
                $event->sheet->getStyle('A' . ($highestRow + 1) . ':' . $lastColumn . ($highestRow + 1))->applyFromArray([
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
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->informasidonasi;

        $collection = new Collection();

        if (isset($data['year'])) {
            $year = $data['year'];
        } else {
            $year = '';
        }

        if (isset($data['month'])) {
            $month = $data['month'];
        } else {
            $month = '';
        }

        $collection->push([
            'Informasi Donasi Donator' . ($year ? ' - Tahun ' . $year : '') . ($month ? ' - ' . $data['months'][$month] : ''),
        ]);

        $collection->push([]);

        $collection->push([
            'No'                => 'No',
            'Nama Donator'      => 'Nama Donator',
            'Jumlah Donasi'     => 'Jumlah Donasi',
        ]);

        $index = 1;

        foreach ($data['results'] as $item) {
            $collection->push([
                'No'                => $index,
                'Nama Donator'      => $item->name,
                'Jumlah Donasi'     => 'Rp ' . number_format($item->total_donation_amount, 2, ',', '.'),
            ]);
            $index++;
        }

        return $collection;
    }

    private function calculateTotalDonasi(Collection $informasidonasi): float
    {
        $totalDonasi = 0;

        foreach ($informasidonasi['results'] as $item) {
            $totalDonasi += $item->total_donation_amount;
        }

        return $totalDonasi;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:C1');

        $sheet->getStyle('A1:C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $styleHeader = [
            'font'      => ['bold' => true],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];

        $sheet->getStyle('A1:' . $lastColumn . '2')->applyFromArray($styleHeader);
        $sheet->getStyle('A3:' . $lastColumn . ($lastRow))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    }

    public function title(): string
    {
        return 'Informasi Donasi Donator';
    }
}
