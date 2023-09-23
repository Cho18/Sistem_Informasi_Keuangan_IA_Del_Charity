<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemasukanRequest extends FormRequest
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
            'donor_id'                  => '',
            'jenis_pemasukan_id'        => 'required',
            'donation_amount'           => 'required',
            'donation_date'             => 'required',
            'type_account'              => 'required',
            'description'               => '',
            'bukti_transaksi'           => 'image|mimes:jpeg,png,jpg,gif'
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
            'jenis_pemasukan_id.required'       => 'Jenis pemasukan harus diisi.',
            'donation_amount.required'          => 'Jumlah donasi harus diisi.',
            'donation_date.required'            => 'Tanggal donasi harus diisi.',
            'type_account.required'             => 'Tipe akun harus diisi.',
            'bukti_transaksi.image'             => 'Bukti transaksi harus berupa file gambar.',
            'bukti_transaksi.mimes'             => 'Bukti transaksi harus dalam format JPEG, PNG, JPG, atau GIF.'
        ];
    }
}
