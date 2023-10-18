<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddIngredientsRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            '*' => 'required|array|min:1|max:1000',
            '*.ingredient_id' => 'required|integer|distinct|exists:ingredients,id',
            '*.amount' => 'required|integer|min:1|max:1000'
        ];
    }
}
