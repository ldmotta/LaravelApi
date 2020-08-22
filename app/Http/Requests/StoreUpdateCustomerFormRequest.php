<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCustomerFormRequest extends FormRequest
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
            'email' => "required|email|unique:customers,email,{$this->segment(3)},id", //valid email 
            'phone' => "required|regex:/^(\(?\d{2}\)?\s?)?(\d{4,5}\-?\d{4})$/",
            'birth_date' => "required|date",
            'address' => "required",
            'district' => "required",
            'zip_code' => "required|min:8|max:8",
        ];
    }
}
