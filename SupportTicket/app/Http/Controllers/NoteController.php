<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $this -> authorize("viewAny", Note::class);

        return(response(NoteResource::collection(Note::all())));
    }

    public function store(StoreNoteRequest $request)
    {
        $validated = $request -> validated();

        $this -> authorize("create", Note::class);

        $validated["user_id"] = auth() -> user() -> id;
        Note::create($validated);

        // TODO: het is beter voor de modulariteit om de opgeslagen resource te returnen en aan de front-end kant een tweede request
        // te doen om de index data op te vragen. Zo kun je uiteindelijk meer doen met je code.
        return($this -> index());
    }
}
