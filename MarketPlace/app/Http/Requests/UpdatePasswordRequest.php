<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|exists:password_resets,email",
            "password" => "required|min:5",
            "token" => "required|exists:password_resets,token"
        ];
    }
}
