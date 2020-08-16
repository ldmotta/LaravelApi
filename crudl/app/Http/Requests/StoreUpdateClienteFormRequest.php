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
            'email' => "required|unique:clientes,email,{$this->segment(3)},id",
            'telefone' => "required:clientes,telefone,{$this->segment(3)},id",
            'nascimento' => "required:clientes,nascimento,{$this->segment(3)},id",
            'endereco' => "required:clientes,endereco,{$this->segment(3)},id",
            'bairro' => "required:clientes,bairro,{$this->segment(3)},id",
            'cep' => "required:clientes,cep,{$this->segment(3)},id",
        ];
    }
}
