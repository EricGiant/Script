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
        return [
            "id" => $this -> id,
            "first_name" => $this -> first_name,
            "last_name" => $this -> last_name,
            "full_name" => $this -> first_name . " " . $this -> last_name,
            "email" => $this -> email,
            "created_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> created_at) -> toDateTimeString(),
            "updated_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> updated_at) -> toDateTimeString()
        ];
    }
}
