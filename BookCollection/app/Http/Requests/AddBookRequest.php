<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|min:1|max:100",
            "img" => "required|mimes:jpeg,png",
            "author_id" => "required|exists:authors,id"
        ];
    }
}
