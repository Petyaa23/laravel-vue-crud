<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => request()->path() === 'update-product' ? 'required' : '',
            "name" => 'required|string|min:3|max:35',
            "price" => 'required|regex:/^[0-9](\.[0-9][0-9][0-9])$/',
            "category_id" => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'price.regex' => "Only number are allowed for this field example 1.111",
        ];
    }

}


