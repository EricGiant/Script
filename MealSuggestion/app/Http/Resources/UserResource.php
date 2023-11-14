<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ingredients = [];
        foreach($this->ingredients as $ingredient )
        {
            array_push($ingredients, ['id' => $ingredient->id, 'amount' => $ingredient->pivot->amount]);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'ingredients' => $ingredients,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->toDateTimeString(),
        ];
    }
}
