<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        // dd(auth() -> user());

        $this -> authorize("viewAny", Note::class);

        return(response(NoteResource::collection(Note::all())));
    }

    public function store(StoreNoteRequest $request)
    {
        $this -> authorize("create", Note::class);

        $validated = $request -> validated();

        $validated["user_id"] = auth() -> user() -> id;
        Note::create($validated);
        
        return($this -> index());
    }
}
