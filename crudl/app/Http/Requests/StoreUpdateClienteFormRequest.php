<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientFormRequest extends FormRequest
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
            'name' => "required:customers,name,{$this->segment(3)},id",
            'email' => "required|unique:customers,email,{$this->segment(3)},id",
            'telefone' => "required:customers,telefone,{$this->segment(3)},id",
            'nascimento' => "required:customers,nascimento,{$this->segment(3)},id",
            'endereco' => "required:customers,endereco,{$this->segment(3)},id",
            'bairro' => "required:customers,bairro,{$this->segment(3)},id",
            'cep' => "required:customers,cep,{$this->segment(3)},id",
        ];
    }
}
