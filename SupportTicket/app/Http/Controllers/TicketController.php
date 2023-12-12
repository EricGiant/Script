<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketAppointedToRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $this -> authorize("viewAny", Ticket::class);

        if(auth() -> user() -> is_admin)
        {
            return TicketResource::collection(Ticket::all());
        }
        else
        {
            return TicketResource::collection(auth() -> user() -> tickets);
        }
    }

    public function store(StoreTicketRequest $request)
    {
        $this -> authorize("create", Ticket::class);

        $validated = $request -> validated();

        $validated["user_id"] = auth() -> user() -> id;
        $ticket = Ticket::create($validated);
        $ticket -> categories() -> sync($validated["category_ids"]);

        return ($this -> index());
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this -> authorize("update", $ticket);

        $validated = $request -> validated();

        $ticket -> update($validated);
        $ticket -> categories() -> sync($validated["category_ids"]);

        return ($this -> index());
    }

    public function updateAppointedTo(UpdateTicketAppointedToRequest $request, Ticket $ticket)
    {
        $this -> authorize("updateAppointedTo", Ticket::class);

        $validated = $request -> validated();

        $ticket -> update(["appointed_to_id" => $validated["appointed_to_id"]]);

        return ($this -> index());
    }

    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        $this -> authorize("updateStatus", Ticket::class);

        $validated = $request -> validated();

        $ticket -> update(["status_id" => $validated["status_id"]]);

        return ($this -> index());
    }
}
