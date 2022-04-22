<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $rules = [
            'description' => 'required|max:255',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = 'required|max:60|unique:services,name,' . $this->route('service')->id;
        } else if($this->method() === 'POST'){
            $rules['name'] = 'required|max:60|unique:services,name';
        }
        return $rules;
    }
}
