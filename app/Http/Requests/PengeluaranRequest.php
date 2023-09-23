<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranRequest extends FormRequest
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
            'jenis_pengeluaran_id'      => 'required',
            'penerima_beasiswa_id'     => '',
            'total_expenditure'         => 'required',
            'expenditure_description'   => '',
            'expenditure_date'          => 'required',
            'proof_of_expenditure'      => 'image|mimes:jpeg,png,jpg,gif'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'proof_of_expenditure.image'     => 'Bukti pengeluaran harus berupa file gambar.',
            'proof_of_expenditure.mimes'     => 'Bukti pengeluaran harus dalam format JPEG, PNG, JPG, atau GIF.'
        ];
    }    
}
