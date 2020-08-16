<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClienteFormRequest extends FormRequest
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
            'nome' => "required:clientes,nome,{$this->segment(3)},id",
            'email' => "required|email|unique:clientes,email,{$this->segment(3)},id", //valid email 
            'telefone' => "required|min:10|max:10",
            'nascimento' => "required|date",
            'endereco' => "required",
            'bairro' => "required",
            'cep' => "required|min:8|max:8",
        ];
    }
}
