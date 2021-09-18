<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'name' => 'required|max:60',
            'surnames' => 'required|max:80',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:20',
            'neighborhood' => 'required|max:45',
            'streets' => 'required|max:80',
            'number' => 'required|numeric|min:1',
            'type_id' => 'required',
        ];
    }
}
