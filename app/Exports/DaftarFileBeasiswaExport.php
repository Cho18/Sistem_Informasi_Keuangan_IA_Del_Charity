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

class DaftarFileBeasiswaExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $daftarfilebeasiswa;

    public function __construct(Collection $daftarfilebeasiswa)
    {
        $this->daftarfilebeasiswa = $daftarfilebeasiswa;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->daftarfilebeasiswa;

        $collection = new Collection();

        $collection->push([
            'Unggahan Berkas Awardee',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                => 'No',
            'Nama Penerima Beasiswa'            => 'Nama Penerima Beasiswa',
            'Judul'                             => 'Judul',
            'Dokumen'                           => 'Dokumen',
            'Tanggal Upload'                    => 'Tanggal Upload',
            'Status'                            => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                                => $index + 1,
                'Nama Penerima Beasiswa'            => $item->penerima_beasiswa->name_awarde,
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
        $sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->daftarfilebeasiswa) + 2;
        $borderRange = 'A2:F' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:F1' => ['font' => ['bold' => true]],
            'A2:F2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Unggahan Berkas Awardee';
    }
}
