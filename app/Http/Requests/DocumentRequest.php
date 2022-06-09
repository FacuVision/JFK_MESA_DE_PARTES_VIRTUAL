<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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

    public function rules(){
        return [
            "pdf1" => "required|mimes:pdf|max:15000",
            "pdf2" => "mimes:pdf|max:15000",
            'office_id'=>'required',
            "anexo" => "mimes:pdf|max:15000",
            'title' =>'required|max:250',
            'content'=>'required|max:500',
            'n_foly'=>'required',
            'typedocument_id'=>'required'
            // 'referencia'=>'required',
            // 'newtipodoc'=>'required'
        ];
    }
    public function attributes()
    {

        return [
            'pdf1' => 'archivo',
            "pdf2" => 'anexos',
            'office_id' => 'oficina',
            'anexo' => 'archivos de anexo',
            'title' => 'asunto',
            'content' => 'descripción',
            'n_foly' => 'numero de folio',
            'typedocument_id' => 'tipo de expediente'
        ];
    }
}
