<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonasiRequest extends FormRequest
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
            'donation_amount' => 'required',
            'donation_date' => 'required',
            'type_account' => 'required',
            'description' => '',
            'bukti_transaksi' => 'image|mimes:jpeg,png,jpg,gif',
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
            'bukti_transaksi'     => 'Bukti donasi',
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
            'bukti_transaksi.image' => 'Bukti transaksi harus berupa file gambar.',
            'bukti_transaksi.mimes' => 'Bukti transaksi harus dalam format JPEG, PNG, JPG, atau GIF.'
        ];
    }
}
