<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisPemasukanRequest extends FormRequest
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
            'name_of_type_income' => 'unique:jenis_pemasukan'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_of_type_income' => 'Jenis Pemasukan',
        ];
    }

    public function messages(): array
    {
        return [
            'name_of_type_income.unique' => 'Jenis pemasukan sudah ada',
        ];
    }
}
