<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileBeasiswaRequest extends FormRequest
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
            'dokumen_id'     => 'required',
            'file_beasiswa'           => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
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
            'dokumen_id.required'       => 'Judul dokumen wajib diisi',
            'file_beasiswa.file'              => 'Dokumen harus berupa file.',
            'file_beasiswa.mimes'             => 'Dokumen harus dalam format pdf, doc, docx, xls, xlsx, ppt, pptx, txt, csv.'
        ];
    }
}
