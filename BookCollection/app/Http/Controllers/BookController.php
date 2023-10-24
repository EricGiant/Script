<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //get all books in DB
    public function getBooks()
    {
        $books = Book::all();
        return response() -> json($books);
    }

    //add new book to DB
    public function addBook(AddBookRequest $request)
    {
        $validated = $request -> validated();

        //store image
        $path = $validated["img"] -> store("public/images");
        $validated["image_path"] = str_replace("public", "/storage", $path);

        //make DB entry
        Book::create($validated);
    }

    //update book in DB
    public function updateBook(UpdateBookRequest $request, Book $book)
    {
        $validated = $request -> validated();

        //update img if needed
        if(isset($validated["img"]))
        {
            //delete old img
            $book -> image_path = str_replace("/storage", "public", $book -> image_path);
            Storage::delete($book -> image_path);

            //upload new img
            $path = $validated["img"] -> store("public/images");
            $validated["image_path"] = str_replace("public", "/storage", $path);
        }

        //update DB entry
        $book -> update($validated);
    }

    //delete book in DB
    public function deleteBook(Book $book)
    {
        //delete img
        $book -> image_path = str_replace("/storage", "public", $book -> image_path);
        Storage::delete($book -> image_path);

        //delete DB entry
        $book -> delete();
    }
}