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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AlbumDokumentasiExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $gallery;

    public function __construct(Collection $gallery)
    {
        $this->gallery = $gallery;
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->gallery;

        $collection = new Collection();

        $collection->push([
            'Daftar Album Dokumentasi',
        ]);

        $collection->push([]);
        $collection->push([
            'No'            => 'No',
            'Gambar'        => 'Gambar',
            'Deskripsi'     => 'Deskripsi',
            'Tanggal'       => 'Tanggal',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'            => $index + 1,
                'Gambar'        => $this->getImageHyperlink($item->images),
                'Deskripsi'     => strip_tags($item->description),
                'Tanggal'       => $item->date,
            ]);
        }

        return $collection;
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
        $sheet->mergeCells('A1:D1');

        $sheet->getStyle('A1:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
        return 'Daftar Album Dokumentasi';
    }
}
