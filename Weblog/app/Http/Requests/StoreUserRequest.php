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
            "name" => "required|between:2,50|unique:users,name",
            "password" => "required|between:5,100",
            "email" => "email|unique:users,email"
        ];
    }
}
