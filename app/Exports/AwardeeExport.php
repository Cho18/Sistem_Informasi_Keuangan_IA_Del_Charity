<?php

namespace App\Exports;

use App\Models\donor;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AwardeeExport implements FromCollection, ShouldAutoSize, WithStyles, WithTitle
{
    protected $awardee;

    public function __construct(Collection $awardee)
    {
        $this->awardee = $awardee;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->awardee;

        $collection = new Collection();

        $collection->push([
            'Daftar Penerima Beasiswa',
        ]);

        $collection->push([]);
        $collection->push([
            'No'                                    => 'No',                     
            'Nama'                                  => 'Nama',
            'NIM'                                   => 'NIM',         
            'Program Studi'                         => 'Program Studi',        
            'Fakultas'                              => 'Fakultas',
            'Angkatan'                              => 'Angkatan',             
            'Email Akademik'                        => 'Email Akademik',
            'Total SPP'                             => 'Total SPP',
            'Tanggal Diberikan Beasiswa'            => 'Tanggal Diberikan Beasiswa',
            'Tanggal Berakhir Beasiswa'             => 'Tanggal Berakhir Beasiswa',
            'Status Beasiswa'                       => 'Status Beasiswa',
            'Tempat/Tanggal Lahir'                  => 'Tempat/Tanggal Lahir',     
            'Jenis Kelamin'                         => 'Jenis Kelamin',
            'Agama'                                 => 'Agama',                
            'Alamat'                                => 'Alamat',
            'Email'                                 => 'Email',
            'Nomor HP'                              => 'Nomor HP',             
            'Anak Ke/Dari'                          => 'Anak Ke/Dari',
            'Tipe Akun'                             => 'Tipe Akun',
            'Nomor Akun'                            => 'Nomor Akun',
            'Nama Pemilik Akun'                     => 'Nama Pemilik Akun',
            'Akun Media Sosial'                     => 'Akun Media Sosial',
            'Hobby'                                 => 'Hobby',
            'Nama Ayah'                             => 'Nama Ayah',
            'Pekerjaan Ayah'                        => 'Pekerjaan Ayah',
            'Pendapatan Ayah'                       => 'Pendapatan Ayah',
            'Nomor HP Ayah'                         => 'Nomor HP Ayah',
            'Nama Ibu'                              => 'Nama Ibu',
            'Pekerjaan Ibu'                         => 'Pekerjaan Ibu',
            'Pendapatan Ibu'                        => 'Pendapatan Ibu',
            'Nomor HP Ibu'                          => 'Nomor HP Ibu',
            'Alamat Orang-Tua'                      => 'Alamat Orang-Tua',
            'Jumlah Tanggungan Orang-Tua'           => 'Jumlah Tanggungan Orang-Tua',
            'Alasan Menerima Beasiswa'              => 'Alasan Menerima Beasiswa',
        ]);

        foreach ($data as $index => $item) {
            $facebook = $item->facebook_awarde;
            $instagram = $item->instagram_awarde;

            if ($facebook !== null && $instagram !== null) {
                $akunMediaSosial = "FB: $facebook IG: @$instagram";
            } elseif ($facebook !== null) {
                $akunMediaSosial = "FB: $facebook";
            } elseif ($instagram !== null) {
                $akunMediaSosial = "IG: @$instagram";
            } else {
                $akunMediaSosial = '-';
            }
            
            $collection->push([
                'No'                                                    => $index + 1,
                'name_awarde'                                           => $item->name_awarde,
                'nim_awarde '                                           => $item->nim_awarde, 
                'study_program'                                         => $item->study_program,        
                'faculty'                                               => $item->faculty,
                'generation'                                            => $item->generation,           
                'email_academics_awarde '                               => $item->email_academics_awarde,
                'total_spp_awarde'                                      => $item->total_spp_awarde,
                'date_set_as_awardee'                                   => $item->date_set_as_awardee,
                'end_date_as_awardee'                                   => $item->end_date_as_awardee,
                'status_beasiswa'                                       => $item->status,
                'place_of_birth/date_of_birth'                          => ($item->place_of_birth !== null && $item->date_of_birth !== null) 
                                                                            ? $item->place_of_birth . '/' . $item->date_of_birth
                                                                            : ($item->place_of_birth !== null ? $item->child_of_awarde . '/-' 
                                                                            : ($item->date_of_birth !== null ? '-/' . $item->date_of_birth : '-')),      
                'gender'                                                => $item->gender,
                'religion'                                              => $item->religion,            
                'address'                                               => $item->address,
                'email_awarde '                                         => $item->email_awarde ,   
                'phone_number_awarde'                                   => $item->phone_number_awarde,                               
                'child_of_awarde/number_of_siblings_awarde'             => ($item->child_of_awarde !== null && $item->number_of_siblings_awarde !== null) 
                                                                            ? $item->child_of_awarde . '/' . $item->number_of_siblings_awarde
                                                                            : ($item->child_of_awarde !== null ? $item->child_of_awarde . '/-' 
                                                                            : ($item->number_of_siblings_awarde !== null ? '-/' . $item->number_of_siblings_awarde : '-')),
                'account_type_awarde'                                   => $item->account_type_awarde,
                'account_number_awarde '                                => $item->account_number_awarde,
                'name_owner_of_account'                                 => $item->name_owner_of_account,
                'Akun Media Sosial'                                     => $akunMediaSosial,
                'hobby'                                                 => $item->hobby,
                'name_of_father_awarde'                                 => $item->name_of_father_awarde,
                'father_occupation_of_awarde'                           => $item->father_occupation_of_awarde,
                'father_income_of_awarde'                               => $item->father_income_of_awarde,
                'father_phone_number_awarde'                            => $item->father_phone_number_awarde,
                'name_of_mother_awarde'                                 => $item->name_of_mother_awarde,
                'mother_occupation_of_awarde'                           => $item->mother_occupation_of_awarde,
                'mother_income_of_awarde'                               => $item->mother_income_of_awarde,
                'mother_phone_number_awarde'                            => $item->mother_phone_number_awarde,
                'address_of_parents_awarde'                             => $item->address_of_parents_awarde,
                'dependents_of_parents_awarde'                          => $item->dependents_of_parents_awarde,
                'description'                                           => strip_tags($item->description),
            ]);
        }

        return $collection;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:AH1');
        $sheet->getStyle('A1:AH2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = count($this->awardee) + 2;
        $borderRange = 'A2:AH' . $lastRow;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        return [
            'A1:AH1' => ['font' => ['bold' => true]],
            'A2:AH2' => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Anggota Awardee';
    }
}
