<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenerimaBeasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_awarde'                   => 'min:3|max:50',
            // 'generation'                    => 'min:2|max:4',
            // 'phone_number_awarde'           => 'min:10|max:13',
            'child_of_awarde'               => 'max:3',
            'number_of_siblings_awarde'     => 'max:3',
            // 'account_number_awarde'         => 'min:10|max:16',
            // 'name_owner_of_account'         => 'min:3|max:50',
            // 'name_of_father_awarde'         => 'min:3|max:50',
            // 'father_phone_number_awarde'    => 'min:10|max:13',
            // 'name_of_mother_awarde'         => 'min:3|max:50',
            // 'mother_phone_number_awarde'    => 'min:10|max:13',
            'dependents_of_parents_awarde'  => 'max:3',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name_awarde'                   => 'Nama',
            'generation'                    => 'Angkatan',
            'phone_number_awarde'           => 'No Handphone',
            'child_of_awarde'               => 'Anak Ke',
            'number_of_siblings_awarde'     => 'Jumlah Saudara',
            'account_number_awarde'         => 'Nomor Akun',
            'name_owner_of_account'         => 'Nama Pemilik Akun',
            'name_of_father_awarde'         => 'Nama Ayah',
            'father_phone_number_awarde'    => 'No HP Ayah',
            'name_of_mother_awarde'         => 'Nama Ibu',
            'mother_phone_number_awarde'    => 'No HP Ibu',
            'dependents_of_parents_awarde'  => 'Jumlah Tanggungan Orang-tua',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name_awarde.min'                   => 'Nama minimal 3 karakter',
            'name_awarde.max'                   => 'Nama maksimal 50 karakter',
            'generation.min'                    => 'Angkatan minimal 2 digit terakhir tahun',
            'generation.max'                    => 'Angkatan maksimal 4 semua digit tahun',
            'phone_number_awarde.min'           => 'No Handphone minimal 10 karakter',
            'phone_number_awarde.max'           => 'No Handphone maksimal 13 karakter',
            'child_of_awarde.max'               => 'Anak ke maksimal 3 karakter',
            'number_of_siblings_awarde.max'     => 'Anak ke maksimal 3 karakter',
            'account_number_awarde.min'         => 'Nomor Akun minimal 10 karakter',
            'account_number_awarde.max'         => 'Nomor Akun maksimal 13 karakter',
            'name_owner_of_account.min'         => 'Nama Pemilik Akun minimal 3 karakter',
            'name_owner_of_account.max'         => 'Nama Pemilik Akun maksimal 50 karakter',
            'name_of_father_awarde.min'         => 'Nama Ayah minimal 3 karakter',
            'name_of_father_awarde.max'         => 'Nama Ayah maksimal 50 karakter',
            'father_phone_number_awarde.min'    => 'No HP Ayah minimal 10 karakter',
            'father_phone_number_awarde.max'    => 'No HP Ayah maksimal 13 karakter',
            'name_of_mother_awarde.min'         => 'Nama Ibu minimal 3 karakter', 
            'name_of_mother_awarde.max'         => 'Nama Ibu maksimal 50 karakter', 
            'mother_phone_number_awarde.min'    => 'No HP Ibu minimal 10 karakter',
            'mother_phone_number_awarde.max'    => 'No HP Ibu maksimal 10 karakter',
            'dependents_of_parents_awarde.max'  => 'Anak ke maksimal 3 karakter',
        ];
    }
}
