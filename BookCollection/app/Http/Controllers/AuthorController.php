<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
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
    }

    //update author in DB
    public function updateAuthor(UpdateAuthorRequest $request, Author $author)
    {
        $validated = $request -> validated();

        //update DB entry
        $author -> update($validated);        
    }

    //delete author in DB
    public function deleteAuthor(Author $author)
    {
        //change all book entries to NO AUTHOR aka ID 1
        $author -> books() -> update(["author_id" => 1]);

        //delete DB entry
        $author -> delete();
    }
}