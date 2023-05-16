<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use COM;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //store comment in DB
    public function store(Request $request)
    {
        //validate request
        $attributes = $request -> validate([
            "content" => "required|max:1000",
            "artical_id" => "required|exists:articals,id"
        ]);

        //make DB entry data
        $attributes["author_id"] = auth() -> user() -> id;

        //make DB entry
        $comment = new Comment($attributes);

        //save DB entry
        $comment -> save();

        //go back to artical
        return back();
    }

    //update selected comment in DB
    public function update(Request $request, Comment $comment)
    {
        //check if user made this comment
        $this -> authorize("update", $comment);
        
        //validate request
        $attributes = $request -> validate([
            "content" => "required|max:1000",
        ]);

        //update comment entry
        $comment -> update($attributes);
        $comment -> save();

        //return back to artical
        return back();
    }

    //remove selected comment in DB
    public function destroy(Comment $comment)
    {
        //check if user made this comment
        $this -> authorize("destroy", $comment);

        //remove comment
        $comment -> delete();
            
        //return to artical
        return back();
    }
}
