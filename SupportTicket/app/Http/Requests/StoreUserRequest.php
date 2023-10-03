<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "required|min:2|max:50",
            "last_name" => "required|min:2|max:50",
            "password" => "required",
            "email" => "required|email|max:255|unique:users,email",
            "telephone_number" => "required|max:255|unique:users,telephone_number"
        ];
    }
}
