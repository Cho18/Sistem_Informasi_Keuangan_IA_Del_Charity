<?php

namespace App\Exports;

use App\Models\dokumen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DaftarDokumenExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $dokumen;

    public function __construct(Collection $dokumen)
    {
        $this->dokumen = $dokumen;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->dokumen;

        $collection = new Collection();

        $collection->push([
            'Daftar Dokumen Awardee',
        ]);

        $collection->push([]);
        $collection->push([
            'No'            => 'No',
            'Judul'         => 'Judul',
            'Dokumen'       => 'Dokumen',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                => $index + 1,
                'Judul'             => $item->name,
                'Dokumen'           => $this->getDocumentHyperlink($item->dokumen),
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
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1:C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->dokumen) + 2;
        $borderRange = 'A2:C' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:C1' => ['font' => ['bold' => true]],
            'A2:C2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Dokumen Awardee';
    }
}
