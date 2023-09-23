<?php

namespace App\Exports;

use App\Models\jenis_pengeluaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JenisPengeluaranExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $jenisPengeluaran;

    public function __construct(Collection $jenisPengeluaran)
    {
        $this->jenisPengeluaran = $jenisPengeluaran;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->jenisPengeluaran;

        $collection = new Collection();

        $collection->push([
            'Daftar Jenis Pengeluaran',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                            => 'No',
            'Jenis Pengeluaran'             => 'Jenis Pengeluaran',
            'Deskripsi Jenis Pengeluaran'   => 'Deskripsi Jenis Pengeluaran',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                            => $index + 1,
                'Jenis Pengeluaran'             => $item->name_of_type_expenditure,
                'Deskripsi Jenis Pengeluaran'   => strip_tags($item->description_of_type_expenditure),
            ]);
        }

        return $collection;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:C1');

        $sheet->getStyle('A1:C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $lastRow; $row++) {
            for ($col = 'A'; $col <= $lastColumn; $col++) {
                $cellCoordinate = $col . $row;
                if ($cellCoordinate !== 'A1' && $cellCoordinate !== 'B1' && $cellCoordinate !== 'C1') {
                    $sheet->getStyle($cellCoordinate)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                }
            }
        }
        return [
            'A1:C1' => ['font' => ['bold' => true]],
            'A2:C2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Jenis Pengeluaran';
    }
}
