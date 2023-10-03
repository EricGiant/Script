<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "content" => "required|min:1|max:4000"
            //user_id has to exist on this ticket and not just in the table, this was hard AF to do and i couldn't figure out last time
        ];
    }
}
