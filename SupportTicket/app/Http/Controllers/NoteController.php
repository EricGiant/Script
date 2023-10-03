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

        return(response(NoteResource::collection(Note::all())));
    }
}
