<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventRequest extends FormRequest
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
            'slug' => Str::slug($this->name) . '-' . $this->route('event')->id,
            'user_id' => Auth::user()->id,
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
            'name' => 'required|max:60',
            'description' => 'required|max:255',
            'price' => 'required|min:0',
            'date' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'place' => 'required|max:255',
            'category_id' => 'required',
            'people' => 'required',
            'points' => 'required',
        ];

        if ($this->method() === 'POST') {
            $rules['cover'] = 'required|mimes:jpg,jpeg,png,bmp|max:5120';
        }

        return $rules;
    }
}
