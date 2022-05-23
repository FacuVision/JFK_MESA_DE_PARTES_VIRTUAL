<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserCreateRequest extends FormRequest
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

            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document" => "required",
            "document_number" => "required|string|max:12|unique:profiles",
            "phone" => "required|numeric|digits:9|unique:profiles",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district_id" => "required",
        ];
    }

    public function attributes()
    {

        return [
            'name' => 'nombre',
            'lastname' => 'apellido',
            'password' => 'contraseña',
            'date_nac' => 'fecha de nacimiento',
            'type_document' => 'tipo de documento',
            'document_number' => 'numero de documento',
            'phone' => 'celular',
            'address' => 'dirección',
            'district_id' => 'distrito',
            'gender' => 'genero'
        ];
    }


}
