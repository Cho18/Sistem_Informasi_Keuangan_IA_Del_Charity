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

class BPHExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $bph;

    public function __construct(Collection $bph)
    {
        $this->bph = $bph;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->bph;

        $collection = new Collection();

        $collection->push([
            'Daftar Anggota BPH',
        ]);

        $collection->push([]);
        $collection->push([
            'No'            => 'No',
            'Nama'          => 'Nama',
            'Angkatan'      => 'Angkatan',
            'Jabatan '      => 'Jabatan ',
            'Divisi '       => 'Divisi ',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'            => $index + 1,
                'Nama'          => $item->nama,
                'Angkatan'      => $item->angkatan,
                'Jabatan'       => $item->status,
                'Divisi '       => $item->divisi,
            ]);
        }

        return $collection;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1:E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->bph) + 2;
        $borderRange = 'A2:E' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:E1' => ['font' => ['bold' => true]],
            'A2:E2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar ';
    }
}
