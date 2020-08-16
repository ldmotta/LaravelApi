<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePastelFormRequest extends FormRequest
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
            'nome' => "required|unique:pasteis,nome,{$this->segment(3)},id",
            'preco' => "required:pasteis,preco,{$this->segment(3)},id",
            'foto' => "required:pasteis,foto,{$this->segment(3)},id",
        ];
    }
}
