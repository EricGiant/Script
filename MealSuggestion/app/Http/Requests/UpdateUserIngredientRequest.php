<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserIngredientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ingredientId' => 'required|exists:ingredient_user,ingredient_id',
            'amount' => 'required|integer|min:1|max:1000'
        ];
    }
}
