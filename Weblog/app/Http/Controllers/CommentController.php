<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use COM;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //store comment in DB
    public function store(StoreCommentRequest $request)
    {
        //get validated data
        $validated = $request -> validatde();

        //make DB entry data
        $validated["author_id"] = auth() -> user() -> id;

        //make DB entry
        Comment::Create($validated);

        //go back to artical
        return back();
    }

    //update selected comment in DB
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //check if user made this comment
        $this -> authorize("update", $comment);
        
        //get validated data
        $validated = $request -> validated();

        //update comment entry
        $comment -> update($validated);

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
