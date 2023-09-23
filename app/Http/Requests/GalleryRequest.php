<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'date'              => 'required',
            'description'       => 'required',
            'images'            => 'image|mimes:jpeg,png,jpg,gif'
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
            'date'          => 'Tanggal wajib diisi.',
            'description'   => 'Deskripsi wajib diisi.',
            'images.image'  => 'Gambar harus berupa file gambar.',
            'images.mimes'  => 'Gambar harus dalam format JPEG, PNG, JPG, atau GIF.'
        ];
    }
}
