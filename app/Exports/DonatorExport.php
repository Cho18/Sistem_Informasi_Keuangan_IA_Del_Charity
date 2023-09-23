<?php

namespace App\Exports;

use App\Models\donor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonatorExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $donator;

    public function __construct(Collection $donator)
    {
        $this->donator = $donator;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->donator;

        $collection = new Collection();

        $collection->push([
            'Daftar Anggota Donator',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                        => 'No',                     
            'Kode Donator'              => 'Kode Donator',         
            'Nama Donator'              => 'Nama Donator',
            'PIC'                       => 'PIC',
            'Alumni'                    => 'Alumni',
            'Tanggal bergabung'         => 'Tanggal bergabung',    
            'Struktur donator'          => 'Struktur donator',
            'Program Studi'             => 'Program Studi',        
            'Fakultas'                  => 'Fakultas',
            'Angkatan'                  => 'Angkatan',             
            'Tempat Lahir'              => 'Tempat Lahir',
            'Tanggal Lahir'             => 'Tanggal Lahir',        
            'Jenis Kelamin'             => 'Jenis Kelamin',
            'Agama'                     => 'Agama',                
            'Alamat'                    => 'Alamat',
            'Email'                     => 'Email',
            'Nomor HP'                  => 'Nomor HP',
            'Status'                    => 'Status',
        ]);

        foreach ($data as $index => $item) {
            $collection->push([
                'No'                            => $index + 1,                         
                'code_name'                     => $item->code_name,            
                'name'                          => $item->name,
                'PIC'                           => $item->bph->nama,
                'Alumni'                        => $item->alumni,
                'date_of_joining'               => $item->date_of_joining,      
                'struktur_donator'              => $item->struktur_donator,
                'study_program'                 => $item->study_program,        
                'faculty'                       => $item->faculty,
                'generation'                    => $item->generation,  
                'Tempat/Tanggal Lahir'          => ($item->place_of_birth !== null && $item->date_of_birth !== null) 
                                                    ? $item->place_of_birth . '/' . $item->date_of_birth
                                                    : ($item->place_of_birth !== null ? $item->child_of_awarde . '/-' 
                                                    : ($item->date_of_birth !== null ? '-/' . $item->date_of_birth : '-')),    
                'gender'                        => $item->gender,
                'religion'                      => $item->religion,            
                'address'                       => $item->address,
                'email'                         => $item->email,   
                'phone_number'                  => $item->phone_number,         
                'description'                   => strip_tags($item->description),
            ]);
        }

        return $collection;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:R1');

        $sheet->getStyle('A1:R2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
            'A1:R1' => ['font' => ['bold' => true]],
            'A2:R2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Anggota Donator';
    }
}
