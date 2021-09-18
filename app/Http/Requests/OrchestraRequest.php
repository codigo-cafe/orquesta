<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrchestraRequest extends FormRequest
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
            'description' => 'required|max:255',
            'mission' => 'required|max:255',
            'vission' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:20',
            'direction' => 'required|max:255',
            'banner' => 'mimes:jpg,jpeg,png,bmp|max:5120',
            'latitude' => 'required|between:-90.999999,90.999999',
            'longitude' => 'required|between:-180.999999,180.999999',
            'iframe' => 'required',
        ];
    }
}
