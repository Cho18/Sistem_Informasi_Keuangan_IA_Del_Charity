<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjuanBeasiswaRequest extends FormRequest
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
            'penerima_beasiswa_id'      => '',
            'total_bursar'              => 'required',
            'semester'                  => 'required',
            'deskripsi'                 => '',
            'bukti'                     => 'image|mimes:jpeg,png,jpg,gif',
            'status'                    => '',
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
            'bukti.image'  => 'Bukti harus berupa file gambar.',
            'bukti.mimes'  => 'Bukti harus dalam format JPEG, PNG, JPG, atau GIF.'
        ];
    }
}
