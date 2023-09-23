<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenRequest extends FormRequest
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
            'name'              => 'required|min:5|max:50',
            'dokumen'           => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
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
            'name.required'         => 'Judul dokumen wajib diisi',
            'name.min'              => 'Judul dokumen minimal 5 karakter',
            'name.max'              => 'Judul dokumen maksimal 50 karakter',
            'dokumen.file'          => 'Dokumen harus berupa file.',
            'dokumen.mimes'         => 'Dokumen harus dalam format pdf, doc, docx, xls, xlsx, ppt, pptx, txt, csv.'
        ];
    }
}
