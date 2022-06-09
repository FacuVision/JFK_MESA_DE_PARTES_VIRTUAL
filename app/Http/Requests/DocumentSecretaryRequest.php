<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentSecretaryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

                'title' => 'required|string',
                'content' => 'required|string',
                'procedingid' => 'required|integer',
                "answer_pdf" => "required|mimes:pdf|max:20000"
        ];

    }

    public function attributes()
    {

        return [
            'title' => 'Título',
            "content" => 'Contenido',
            'procedingid' => 'Expediente',
            'answer_pdf' => 'Archivo principal',
        ];
    }
}
