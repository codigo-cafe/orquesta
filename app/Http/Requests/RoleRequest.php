<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'guard_name' => 'web',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'guard_name' => 'required',
            'permissions' => 'required',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = 'required|max:45|unique:roles,name,' . $this->route('role')->id;
        } else if($this->method() === 'POST'){
            $rules['name'] = 'required|max:45|unique:roles,name';
        }
        return $rules;
    }
}
