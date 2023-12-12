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
            return (ResponseResource::collection(Response::all()));
        }

        return (ResponseResource::collection(auth() -> user() -> tickets -> responses));
    }

    public function store(StoreResponseRequest $request, Ticket $ticket)
    {
        $this -> authorize("create", Response::class);

        $validated = $request -> validated();

        if($ticket -> user_id != $validated["ticket_user_id"])
        {
            return response() -> json(["message" => "given user_id is not corresponding to ticket_user_id"], 422);
        }

        $validated["ticket_id"] = $ticket -> id;
        Response::create($validated);

        Mail::to($ticket -> user-> email) -> send(new TicketResponse($ticket -> id));

        return ($this -> index());
    }

    public function update(UpdateResponseRequest $request, Response $response)
    {
        $this -> authorize("update", Response::class);

        $validated = $request -> validated();

        $response -> update($validated);

        return ($this -> index());
    }
}
