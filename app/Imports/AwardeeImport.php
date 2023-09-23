<?php

namespace App\Imports;

use App\Models\penerima_beasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class AwardeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new penerima_beasiswa([
            'name_awarde'   =>  $row[0],  // Nama
            'date_set_as_awardee'   =>  $row[1],  // Tahun Masuk
            'generation'   =>  $row[2],  // Angkatan
            // $row[3],   // Kolom ke-4
            'total_spp_awarde'   =>  $row[4],  // Jumlah SPP
            'study_program'   =>  $row[5],  // Jurusan
            'account_type_awarde'   =>  $row[6],  // Jenis Rekening
            'account_number_awarde'   =>  $row[7],  // No Rekening
            'name_owner_of_account'   =>  $row[8],  // A/N
            'father_phone_number_awarde'   =>  $row[9],  // No HP Orang Tua
            // $row[10],   // Kolom ke-11
            'address'   =>  $row[11],  // Alamat
            'email_academics_awarde'   =>  $row[12],  // Email 1 (Kampus)
            'email_awarde'   =>  $row[13],  // Email 2 (GMAIL)
            'phone_number_awarde'   =>  $row[14],  // No HP Aktif
            'instagram_awarde'   =>  $row[15],  // Medsos (Facebook dan IG)
            'hobby'   =>  $row[16],  // Hobby
            'child_of_awarde'   =>  $row[17],  // Anak Ke / Dari
            'dependents_of_parents_awarde'   =>  $row[18],  // Tanggungan Orang Tua
            'name_of_father_awarde'   =>  $row[19],  // Nama Ayah
            'name_of_mother_awarde'   =>  $row[20],  // Nama Ibu
            'father_occupation_of_awarde'   =>  $row[21],  // Pekerjaan Ayah
            'father_income_of_awarde'   =>  $row[22],  // Range Penghasilan Ayah
            'mother_occupation_of_awarde'   =>  $row[23],  // Pekerjaan Ibu
            'mother_income_of_awarde'   =>  $row[24],  // Range Penghasilan Ibu
            // $row[25],   // Kolom ke-26
            'description'   =>  $row[26],  // Deskripsi
        ]);
    }
}

// 'name_awarde'   =>  $row['Nama'],
            // 'date_set_as_awardee'   =>  $row['Tahun Masuk'],
            // 'generation'   =>  $row['Angkatan'],
            // // ''   =>  $row[3],
            // 'total_spp_awarde'   =>  $row['Jumlah SPP'],
            // 'study_program'   =>  $row['Jurusan'],
            // 'account_type_awarde'   =>  $row['Jenis Rekening'],
            // 'account_number_awarde '   =>  $row['No Rekening'],
            // 'name_owner_of_account'   =>  $row['A/N'],
            // 'father_phone_number_awarde'   =>  $row['No HP Orang Tua'],
            // // ''   =>  $row[10],
            // 'address'   =>  $row['Alamat'],
            // 'email_academics_awarde '   =>  $row['Email 1 (Kampus)'],
            // 'email_awarde '   =>  $row['Email 2 (GMAIL)'],
            // 'phone_number_awarde'   =>  $row['No HP Aktif'],
            // 'instagram_awarde'   =>  $row['Medsos (Facebook dan IG)'],
            // 'hobby'   =>  $row['Hobby'],
            // 'child_of_awarde'   =>  $row['Anak Ke / Dari'],
            // 'dependents_of_parents_awarde'   =>  $row['Tanggungan Orang Tua'],
            // 'name_of_father_awarde'   =>  $row['Nama Ayah'],
            // 'name_of_mother_awarde'   =>  $row['Nama Ibu'],
            // 'father_occupation_of_awarde'   =>  $row['Pekerjaan Ayah'],
            // 'father_income_of_awarde'   =>  $row['Range Penghasilan Ayah'],
            // 'mother_occupation_of_awarde'   =>  $row['Pekerjaan Ibu'],
            // 'mother_income_of_awarde'   =>  $row['Range Penghasilan Ibu'],
            // // ''   =>  $row[25],
            // 'description'   =>  $row['Deskripsi'],