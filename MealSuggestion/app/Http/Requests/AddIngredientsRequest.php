<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddIngredientsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*' => 'required|array|min:1|max:100',
            '*.ingredientId' => 'required|integer|distinct|exists:ingredients,id',
            '*.amount' => 'required|integer|min:1|max:1000'
        ];
    }
}
