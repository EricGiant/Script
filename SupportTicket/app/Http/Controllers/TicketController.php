<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    public function getTickets()
    {
        $tickets = Ticket::all();
        return response() -> json($tickets);
    }
}
