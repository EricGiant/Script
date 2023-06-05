<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Chat;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //show all posts
    public function index()
    {
        //get all posts
        $posts = Post::paginate(10);

        return view("post/index", ["posts" => $posts]);
    }

    //show create post form
    public function create()
    {
        return view("post/create");
    }

    //store new post
    public function store(StorePostRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //store image if added
        if(isset($validated["image"]))
        {
            $path = $validated["image"] -> store("public/images");
            $validated["image_path"] = str_replace("public", "storage", $path);
        }
        
        //make new post
        $validated["user_id"] = Auth() -> user() -> id;
        $post = new Post($validated);
        $post -> save();


        //go back to editPage
        return redirect("/post/editPage");
    }

    //show selected post
    public function show(Post $post)
    {
        $chat = null;
        if(auth() -> user() != null)
        {
            //get user placed bid
            $userBid = $post -> bids -> where("user_id", auth() -> user() -> id) -> first();
            
            //load user placed bid into user
            auth() -> user() -> bid = $userBid;

            //load chat with seller
            $query = Chat::query();
            $query -> where(function($q) use ($post)
            {
                $q -> where("user1_id", $post -> user -> id) -> where("user2_id", auth() -> user() -> id);
            }) -> orWhere(function($q) use ($post)
            {
                $q -> where("user1_id", auth() -> user() -> id) -> where("user2_id", $post -> user -> id);
            });
            $chat = $query -> first();
        }
        
        //if chat is null make action a make chat
        $action = "/chat/";
        if($chat == null)
        {
            $action .= "store";
        }
        //else make action load chat
        else
        {
            $action .= $chat["id"];
        }
            
        return view("post/show", ["post" => $post, "action" => $action]);
    }

    //show all posts made by user and allow editing to them
    public function editPage()
    {
        return view("post/editPage");
    }

    //show edit form for selected post
    public function edit(Post $post)
    {
        return view("post/edit", ["post" => $post]);
    }

    //update selected post
    public function update(UpdatePostRequest $request, Post $post)
    {
        //check if user made this post
        $this -> authorize("update", $post);

        //get validated data
        $validated = $request -> validated();

        //update image if added
        if(isset($validated["image"]))
        {
            //delete old image
            Storage::delete($post -> image_path);

            //upload new image
            $path = $validated["image"] -> store("public/images");
            $validated["image_path"] = str_replace("public", "storage", $path);
        }

        //update post
        $post -> update($validated);

        //go back to edit page
        return redirect("/post/editPage");
    }

    //destroy selected post
    public function destroy(Post $post)
    {
        //check if user made this post
        $this -> authorize("delete", $post);

        //delete image if it had one
        if($post -> image_path != null)
        {
            Storage::delete($post -> image_path);
        }

        //delete post
        $post -> delete();

        //go back to old page
        return back();
    }
}
