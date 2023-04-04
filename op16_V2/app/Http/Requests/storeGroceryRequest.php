<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeGroceryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|between:2,100",
            "price" => "required|numeric|between:0.01,9999.99",
            "amount" => "required|digits_between:1,100",
            "category" => "required|digits_between:1,9"
        ];
    }
}
