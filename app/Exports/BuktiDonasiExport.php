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

class BuktiDonasiExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $buktidonasi;

    public function __construct(Collection $buktidonasi)
    {
        $this->buktidonasi = $buktidonasi;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Donasi');
                $event->sheet->setCellValue('B' . ($highestRow + 1), $this->calculateTotalDonasi($this->buktidonasi));
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
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->buktidonasi;

        $collection = new Collection();

        $collection->push([
            'Daftar Bukti Donasi Saya',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                        => 'No',
            'Jumlah Donasi'             => 'Jumlah Donasi',
            'Tanggal Donasi'            => 'Tanggal Donasi',
            'Tipe Akun'                 => 'Tipe Akun',
            'Bukti Transaksi'           => 'Bukti Transaksi',
            'Deskripsi'                 => 'Deskripsi',
            'Status'                    => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                    => $index + 1,
                'Jumlah Donasi'         => $item->donation_amount,
                'Tanggal Donasi'        => $item->donation_date,
                'Tipe Akun'             => $item->type_account,
                'Bukti Transaksi'       => $this->getImageHyperlink($item->bukti_transaksi),
                'Deskripsi'             => strip_tags($item->description),
                'Status'                => $item->status,
            ]);
        }

        return $collection;
    }

    private function calculateTotalDonasi(Collection $daftarbuktidonasi): float
    {
        $totaldonasi = 0;

        foreach ($daftarbuktidonasi as $item) {
            $totaldonasi += $item->donation_amount;
        }

        return $totaldonasi;
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
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->buktidonasi) + 2;
        $borderRange = 'A2:G' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:G1' => ['font' => ['bold' => true]],
            'A2:G2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Bukti Donasi Saya';
    }
}
