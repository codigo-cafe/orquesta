<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserManualRequest extends FormRequest
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
            'role_id' => 'required',
        ];
        if ($this->method() === 'PUT') {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->route('user')->id;
        } else if($this->method() === 'POST'){
            $rules['person_id'] = 'required';
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['password'] = 'required|max:255';
        }
        return $rules;
    }
}
