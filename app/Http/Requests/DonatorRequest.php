<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonatorRequest extends FormRequest
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
            'code_name'     => 'unique:donors',
            'name'          => 'min:3|max:50',
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
            'code_name'     => 'Kode Nama Donator',
            'name'          => 'Nama Donator',
            'generation'    => 'Angkatan',
            'phone_number'  => 'No Handphone',
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
            'code_name.unique'  => 'Kode Nama Donator sudah ada',
            'name.min'          => 'Nama Donator minimal 3 karakter',
            'name.max'          => 'Nama Donator maksimal 50 karakter',
            'generation.min'    => 'Angkatan minimal 2 digit terakhir tahun',
            'generation.max'    => 'Angkatan maksimal semua digit tahun',
            'phone_number.min'  => 'No Handphone minimal 10 karakter',
            'phone_number.max'  => 'No Handphone maksimal 13 karakter',
        ];
    }
}
