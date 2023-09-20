<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            "title" => $this -> title,
            "content" => $this -> content,
            "appointed_to_id" => $this -> appointed_to_id,
            "status_id" => $this -> status_id,
            "user_id" => $this -> user_id,
            "category_ids" => $this -> categories -> pluck("id"),
            "created_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> created_at) -> toDateTimeString(),
            "updated_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> updated_at) -> toDateTimeString()
        ];
    }
}
