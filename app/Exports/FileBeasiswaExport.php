<?php

namespace App\Exports;

use App\Models\ajuan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Storage;

class FileBeasiswaExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $file_beasiswa;

    public function __construct(Collection $file_beasiswa)
    {
        $this->file_beasiswa = $file_beasiswa;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->file_beasiswa;

        $collection = new Collection();

        $collection->push([
            'Daftar File Beasiswa Saya',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                => 'No',
            'Judul'                             => 'Judul',
            'Dokumen'                           => 'Dokumen',
            'Tanggal Upload'                    => 'Tanggal Upload',
            'Status'                            => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                                => $index + 1,
                'Judul'                             => $item->dokumen->name,
                'Dokumen'                           => $this->getDocumentHyperlink($item->file_beasiswa),
                'Tanggal Upload'                    => $item->tanggal_upload,
                'Status'                            => $item->status,
            ]);
        }

        return $collection;
    }

    private function getDocumentHyperlink(?string $documentPath): ?string
    {
        if ($documentPath) {
            $fileName = basename($documentPath);
            $fileUrl = asset('storage/' . $documentPath);

            return '=HYPERLINK("' . $fileUrl . '", "' . $fileName . '")';
        }

        return null;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1:E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->file_beasiswa) + 2;
        $borderRange = 'A2:E' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:E1' => ['font' => ['bold' => true]],
            'A2:E2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar File Beasiswa Saya';
    }
}
