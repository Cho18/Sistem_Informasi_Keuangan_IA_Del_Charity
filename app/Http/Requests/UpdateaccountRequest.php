<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateaccountRequest extends FormRequest
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
        $userId = optional($this->route('account'))->id;

        return [
            'name'          => 'required|max:50|min:5',
            'email'         => 'required|email|' . $userId,
            'profile'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'password'      => 'min:5|max:15',
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
            'name.required'         => 'Username wajib diisi.',
            'name.max'              => 'Username maksimal 50 karakter.',
            'name.min'              => 'Username minimal 15 karakter.',
            'email.required'        => 'Email wajib diisi.',
            'password.required'     => 'Password wajib diisi.',
            'password.max'          => 'Password maksimal 15 karakter.',
            'password.min'          => 'Password minimal 5 karakter.',
            'profile.image'         => 'Foto profil harus berupa file gambar.',
            'profile.mimes'         => 'Foto profil harus dalam format JPEG, PNG, JPG, atau GIF.',
            'email.unique'          => 'Email sudah ada yang menggunakan'
        ];
    }
}
