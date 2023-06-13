<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //show all posts
    public function index(Request $request)
    {
        //make query builder
        $posts = Post::query();

        //get all categories
        $categories = Category::all();

        //get search data
        $searchData = $request -> collect() -> filter();

        //check for searchData
        if(!$searchData -> isEmpty())
        {
            //check for categories
            if(isset($searchData["categories"]))
            {
                $posts =$posts -> whereHas("categories", function(Builder $query) use ($searchData)
                {
                    $query -> whereIn("category_id", $searchData["categories"]);
                });
            }

            //check for search
            if(isset($searchData["search"]))
            {
                $posts = $posts -> where("name", "LIKE", "%" . $searchData["search"] . "%");
            }
        }

        // sort posts on most recently advertised
        $posts = $posts -> orderBy("advertised_at", "desc");

        //get posts
        $posts = $posts -> paginate(10);

        return view("post/index", ["posts" => $posts, "categories" => $categories]);
    }

    //show create post form
    public function create()
    {
        //get all categories
        $categories = Category::all();
    
        return view("post/create", ["categories" => $categories]);
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
        $validated["advertised_at"] = Carbon::now();
        $post = Post::create($validated);

        //make junction
        $post -> categories() -> sync($validated["categories"]);

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
        //get all categories
        $categories = Category::all();
        
        return view("post/edit", ["post" => $post, "categories" => $categories]);
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
            if($post -> image_path != null)
            {
                Storage::delete($post -> image_path);
            }

            //upload new image
            $path = $validated["image"] -> store("public/images");
            $validated["image_path"] = str_replace("public", "storage", $path);
        }

        //update post
        $post -> update($validated);

        //update junction
        $post -> categories() -> sync($validated["categories"]);

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

    //advertise post
    public function advertise(Post $post)
    {
        //check if user made this post
        $this -> authorize("advertise", $post);

        //update time
        $post -> update(["advertised_at" => Carbon::now() -> toDateTimeString()]);

        //go back to old page
        return back();
    }
}
