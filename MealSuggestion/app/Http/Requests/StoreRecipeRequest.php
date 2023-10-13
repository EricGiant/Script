<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
            'name' => 'required|min:1|max:255|unique:recipes,name',
            'content' => 'required|min:1|max:4000',
            'ingredients' => 'required|array|min:1|max:50',
            'ingredients.*.id' => 'required|integer|distinct|exists:ingredients,id',
            'ingredients.*.amount' => 'required|integer|min:1|max:100'
        ];
    }
}
