<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|max:255",
            "content" => "required",
            "categories" => "required|min:1",
            "isPremium" => "required|min:0|max:1",
            "image" => "|mimes:jpeg,png|max:16512"
        ];
    }
}
