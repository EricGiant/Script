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
        // dd(Ticket::all());
        return TicketResource::collection(Ticket::all());
    }

    public function store(StoreTicketRequest $request)
    {
        $validated = $request -> validated();

        $this -> authorize("create", Ticket::class);

        $validated["user_id"] = auth() -> user() -> id;
        Ticket::create($validated);

        return(response(TicketResource::collection(Ticket::all())));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validated = $request -> validated();

        $this -> authorize("update", $ticket);

        $ticket -> update($validated);

        return(response(TicketResource::collection(Ticket::all())));
    }

    public function updateAppointedTo(UpdateTicketAppointedToRequest $request, Ticket $ticket)
    {
        $validated = $request -> validated();

        $this -> authorize("updateAppointedTo", Ticket::class);

        $ticket -> update(["appointed_to_id" => $validated["appointed_to_id"]]);

        return(response(TicketResource::collection(Ticket::all())));
    }

    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        $validated = $request -> validated();

        $this -> authorize("updateStatus", Ticket::class);

        $ticket -> update(["status_id" => $validated["status_id"]]);

        return(response(TicketResource::collection(Ticket::all())));
    }
}
