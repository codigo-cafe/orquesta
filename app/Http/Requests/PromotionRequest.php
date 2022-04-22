<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'discount' => 'required|numeric|min:0|max:255',
            'date_start' => 'required',
            'date_end' => 'required',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = 'required|max:60|unique:promotions,name,' . $this->route('promotion')->id;
        } else if($this->method() === 'POST'){
            $rules['name'] = 'required|max:60|unique:promotions,name';
        }
        return $rules;
    }
}
