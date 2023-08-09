<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    //get all authors
    public function getAuthors()
    {
        $authors = Author::all();
        return response() -> json($authors);
    }

    //add new author to DB
    public function addAuthor(AddAuthorRequest $request)
    {
        $validated = $request -> validated();
        
        //add new author to DB
        Author::create($validated);

        //load new data in
        $authors = Author::all();
        return response() -> json($authors);
    }
}