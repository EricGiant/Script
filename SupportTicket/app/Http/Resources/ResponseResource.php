<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
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
            "content" => $this -> content,
            "ticket_id" => $this -> ticket_id,
            "created_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> created_at) -> toDateTimeString(),
            "updated_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> updated_at) -> toDateTimeString()
        ];
    }
}
