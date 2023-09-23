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

class PemasukanExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $daftarpemasukan;

    public function __construct(Collection $daftarpemasukan)
    {
        $this->daftarpemasukan = $daftarpemasukan;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->mergeCells('A' . ($highestRow + 1) . ':C' . ($highestRow + 1));
                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Pemasukan');
                $event->sheet->setCellValue('D' . ($highestRow + 1), $this->calculateTotalPemasukan($this->daftarpemasukan));
                $event->sheet->getStyle('A' . ($highestRow + 1) . ':' . $lastColumn . ($highestRow + 1))->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn);

                $event->sheet->mergeCellsByColumnAndRow(5, $highestRow + 1, $lastColumnIndex, $highestRow + 1);
                $event->sheet->getStyleByColumnAndRow(5, $highestRow + 1, $lastColumnIndex, $highestRow + 1)->applyFromArray([
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
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->daftarpemasukan;

        $collection = new Collection();

        $collection->push([
            'Daftar Pemasukan',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                    => 'No',
            'Jenis Pemasukan'       => 'Jenis Pemasukan',
            'Nama Donator'          => 'Nama Donator',
            'Jumlah Pemasukan'      => 'Jumlah Pemasukan',
            'Tanggal Pemasukan'     => 'Tanggal Pemasukan',
            'Tipe Akun'             => 'Tipe Akun',
            'Bukti Transaksi'       => 'Bukti Transaksi',
            'Deskripsi'             => 'Deskripsi',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                    => $index + 1,
                'Jenis Pemasukan'       => $item->jenis_pemasukan->name_of_type_income,
                'Nama Donator'          => $item->donor->name ?? '-',
                'Jumlah Pemasukan'      => $item->donation_amount,
                'Tanggal Pemasukan'     => $item->donation_date,
                'Tipe Akun'             => $item->type_account,
                'Bukti Transaksi'       => $this->getImageHyperlink($item->bukti_transaksi),
                'Deskripsi'             => strip_tags($item->description),
            ]);
        }

        return $collection;
    }

    private function calculateTotalPemasukan(Collection $donasidonator): float
    {
        $totalPemasukan = 0;

        foreach ($donasidonator as $item) {
            $totalPemasukan += $item->donation_amount;
        }

        return $totalPemasukan;
    }

    private function getImageHyperlink(?string $imagePath): ?string
    {
        if ($imagePath) {
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

            if (in_array(strtolower($fileExtension), $imageExtensions)) {
                $imageFullPath = asset('storage/' . $imagePath);
                $imageName = basename($imagePath);
                return '=HYPERLINK("' . $imageFullPath . '", "' . $imageName . '")';
            }
        }

        return $imagePath ? basename($imagePath) : null;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');

        $sheet->getStyle('A1:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
        return 'Daftar Pemasukan';
    }
}
