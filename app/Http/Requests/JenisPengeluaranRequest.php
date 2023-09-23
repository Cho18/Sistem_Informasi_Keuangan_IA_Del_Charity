<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisPengeluaranRequest extends FormRequest
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
            'name_of_type_expenditure' => 'unique:jenis_pengeluaran'
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
            'name_of_type_expenditure' => 'Jenis Pengeluaran',
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
            'name_of_type_expenditure.unique' => 'Jenis pengeluaran sudah ada',
        ];
    }
}
