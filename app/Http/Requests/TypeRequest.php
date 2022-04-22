<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
        $rules = [];

        if ($this->method() === 'PUT') {
            $rules['name'] = 'required|max:45|unique:types,name,' . $this->route('type')->id;
        } else if($this->method() === 'POST'){
            $rules['name'] = 'required|max:45|unique:types,name';
        }
        return $rules;
    }
}
