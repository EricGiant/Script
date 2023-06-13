<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required|min:5",
            "image" => "nullable|mimes:jpeg,png",
            "content" => "required|min:5",
            "categories" => "required|min:1"
        ];
    }
}
