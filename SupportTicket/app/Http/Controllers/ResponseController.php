<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Mail\TicketResponse;
use App\Models\Response;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ResponseController extends Controller
{
    public function index()
    {
        $this -> authorize("viewAny", Response::class);

        if(auth() -> user() -> is_admin)
        {
            return response(ResponseResource::collection(Response::all()));
        }
        $responses = [];
        foreach(auth() -> user() -> tickets as $ticket)
        {
            foreach($ticket -> responses as $response)
            {
                array_push($responses, $response);
            }
        }
        return response(ResponseResource::collection($responses));
    }

    public function store(StoreResponseRequest $request, Ticket $ticket)
    {
        $validated = $request -> validated();

        $this -> authorize("create", Response::class);

        if($ticket -> user_id != $validated["ticket_user_id"])
        {
            return response() -> json(["message" => "given user_id is not corresponding to ticket_user_id"], 422);
        }

        $validated["ticket_id"] = $ticket -> id;
        Response::create($validated);

        Mail::to(User::find($ticket -> user_id) -> email) -> send(new TicketResponse($ticket -> id));

        return response($this -> index());
    }

    public function update(UpdateResponseRequest $request, Response $response)
    {
        $validated = $request -> validated();

        $this -> authorize("update", Response::class);

        $response -> update($validated);

        return response($this -> index());
    }
}
