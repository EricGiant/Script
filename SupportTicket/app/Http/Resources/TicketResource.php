<?php

namespace App\Http\Resources;

use App\Models\User;
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
        $appointedUser = "";
        if($this -> appointed_to_user != null)
        {
            $appointedUser = $this -> appointed_to_user -> first_name . " " . $this -> appointed_to_user -> last_name;
        }
        else
        {
            $appointedUser = null;
        }

        return [
            "id" => $this -> id,
            "title" => $this -> title,
            "content" => $this -> content,
            // "appointed_to_id" => $this -> appointed_to_id,
            "appointed_to_user" => $appointedUser,
            "status_id" => $this -> status_id,
            "status" => $this -> status -> title,
            // "user_id" => $this -> user_id,
            "responses" => $this->responses,
            "user" => $this -> user -> first_name . " " . $this -> user -> last_name,
            "category_ids" => $this -> categories -> pluck("id"),
            "created_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> created_at) -> toDateTimeString(),
            "updated_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this -> updated_at) -> toDateTimeString()
        ];
    }
}
