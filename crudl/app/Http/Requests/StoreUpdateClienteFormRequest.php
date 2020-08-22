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
            'phone' => "required:customers,phone,{$this->segment(3)},id",
            'birth_date' => "required:customers,birth_date,{$this->segment(3)},id",
            'address' => "required:customers,address,{$this->segment(3)},id",
            'district' => "required:customers,district,{$this->segment(3)},id",
            'zip_code' => "required:customers,zip_code,{$this->segment(3)},id",
        ];
    }
}
