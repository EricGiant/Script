<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class RecipeResource extends JsonResource
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
            array_push($ingredients, ['id' => $ingredient->id, 'amount' => DB::table('ingredient_recipe')->where('recipe_id', $this -> id)->where('ingredient_id', $ingredient->id)->pluck('amount')]);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'ingredients' => $ingredients, //TEMPORARILY JUST MAKE IT WORK ASK JASPER FOR HELP ON THIS
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->toDateTimeString(),
        ];
    }
}
