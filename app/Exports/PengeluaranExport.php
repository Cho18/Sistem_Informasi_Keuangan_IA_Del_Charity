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

class PengeluaranExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle, WithEvents, WithColumnFormatting
{
    protected $pengeluaran;

    public function __construct(Collection $pengeluaran)
    {
        $this->pengeluaran = $pengeluaran;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $lastColumn = $event->sheet->getHighestColumn();

                $event->sheet->mergeCells('A' . ($highestRow + 1) . ':C' . ($highestRow + 1));
                $event->sheet->setCellValue('A' . ($highestRow + 1), 'Total Pengeluaran');
                $event->sheet->setCellValue('D' . ($highestRow + 1), $this->calculateTotalPengeluaran($this->pengeluaran));
                $event->sheet->getStyle('A' . ($highestRow + 1) . ':' . $lastColumn . ($highestRow + 1))->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $lastColumnIndex = Coordinate::columnIndexFromString($lastColumn);

                $event->sheet->mergeCellsByColumnAndRow(5, $highestRow + 1, 7, $highestRow + 1);
                $event->sheet->getStyleByColumnAndRow(5, $highestRow + 1, 7, $highestRow + 1)->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
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
        $data = $this->pengeluaran;

        $collection = new Collection();

        $collection->push([
            'Daftar Pengeluaran',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                => 'No',
            'Jenis Pengeluaran'                 => 'Jenis Pengeluaran',
            'Nama Penerima Beasiswa'            => 'Nama Penerima Beasiswa',
            'Jumlah Pengeluaran'                => 'Jumlah Pengeluaran',
            'Tanggal Pengeluaran'               => 'Tanggal Pengeluaran',
            'Bukti Pengeluaran'                 => 'Bukti Pengeluaran',
            'Deskripsi Pengeluaran'             => 'Deskripsi Pengeluaran',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                            => $index + 1,
                'Jenis Pengeluaran'             => $item->jenis_pengeluaran->name_of_type_expenditure,
                'Nama Penerima Beasiswa'        => $item->penerima_beasiswa->name_awarde ?? '-',
                'Jumlah Pengeluaran'            => $item->total_expenditure,
                'Tanggal Pengeluaran'           => $item->expenditure_date,
                'Bukti Pengeluaran'             => $this->getImageHyperlink($item->proof_of_expenditure),
                'Deskripsi Pengeluaran'         => strip_tags($item->expenditure_description),
            ]);
        }

        return $collection;
    }

    private function calculateTotalPengeluaran(Collection $pengeluaran): float
    {
        $totalPengeluaran = 0;

        foreach ($pengeluaran as $item) {
            $totalPengeluaran += $item->total_expenditure;
        }

        return $totalPengeluaran;
    }

    /**
     * Create hyperlink for images
     * 
     * @param string|null $imagePath
     * @param int|null $jenisPengeluaranId
     * @return Hyperlink|null
     */
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
        $sheet->mergeCells('A1:F1');

        $sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
        return 'Daftar Pengeluaran';
    }
}
