<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticalRequest;
use App\Models\Artical;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Comment;

class ArticalController extends Controller
{
    //show index page
    public function index(Request $request)
    {
        //make empty query builder
        $articals = Artical::query();

        //get categories
        $categories = Category::all();
        
        if($request -> has("categories"))
        {
            //get selected categories
            $selectedCategories = $request -> get("categories");

            //get articals with selected categories
            $articals = $articals -> whereHas("categories", function(Builder $query) use ($selectedCategories) 
            {
                // TODO: moet category_id niet id zijn?
                $query -> whereIn("category_id", $selectedCategories); //this line erros due to weird intelephenses, disable method diagnostic or potentially get a IDE helper https://github.com/barryvdh/laravel-ide-helper 
            }) -> get();
        }
        else
        {
            //get all articals
            $articals = $articals -> get();
        }

        //sort on upload date aka inverse collection since most recent ID is the most recent post
        $articals = $articals -> reverse();

        //load page
        return view("artical/index", ["articals" => $articals, "categories" => $categories]);
    }

    //show writing page
    public function create()
    {
        //get categories
        $categories = Category::all();

        //build data query
        $data["categories"] = $categories;
        
        //get session data if any exists
        $sessionData = session() -> get("data");

        //check if there is session data
        if($sessionData != null)
        {
            //add to data array
            $keys = array_keys($sessionData);
            for($i = 0; $i < count($sessionData); $i++)
            {
                $data[$keys[$i]] = $sessionData[$keys[$i]];
            }
        }

        //load page
        return view("artical/create", $data);
    }

    //stores new artical in DB
    public function store(ArticalRequest $request)
    {
        //wont work normally BECAUSE I CANT FIND THE FCKING FILE THAT INCREASED PACKET SIZE SO ONLY WORKS VIA SQL COMMANDS
        //SET GLOBAL max_allowed_packet=1073741824;

        //get validated data
        $validated = $request -> validated();
        $validated["author_id"] = auth() -> user() -> id;

        //make artical DB entry
        $artical = new Artical($validated);

        //add image if needed
        if(isset($validated["image"]))
        {
            //add image to DB entry
            $artical -> image = $validated["image"] -> get();
        }

        //save artical DB entry
        $artical -> save();

        //update junction entries
        $artical -> categories() -> sync($request -> get("categories"));

        //redirect to manage articals page
        return redirect("/profile/edit");
    }

    //show selected artical
    public function show(Artical $artical)
    {
        //encode image to base64 so img can load it
        $artical -> image = base64_encode($artical -> image);

        //load page
        return view("artical/show", ["artical" => $artical]);
    }

    //show edit page for selected artical 
    public function edit(Artical $artical)
    {     
        //check if selected artical is an artical the user has writen
        $this -> authorize("edit", $artical);

        //get all categories
        $categories = Category::all();

        //build data query
        $data["categories"] = $categories;
        $data["artical"] = $artical;
        
        //get session data if any exists
        $sessionData = session() -> get("data");

        //check if there is session data
        if($sessionData != null)
        {
            //add to data array
            $keys = array_keys($sessionData);
            for($i = 0; $i < count($sessionData); $i++)
            {
                $data[$keys[$i]] = $sessionData[$keys[$i]];
            }
        }

        //load page
        return view("artical/edit", $data);
    }

    //update selected artical in DB
    public function update(ArticalRequest $request, Artical $artical)
    {
        //ceheck if selected artical is an artical the user has writen
        $this -> authorize("update", $artical);

        $validated = $request -> validated();

        //update junction entries
        $artical -> categories() -> sync($validated["categories"]);

        //update artical entry
        $artical -> update($validated);
        
        //update image if needed
        if(isset($validated["image"]))
        {
            //add image to DB entry
            $artical -> image = $validated["image"] -> get();
            $artical -> save();
        }

        //redirect to manage articals page
        return redirect("/profile/edit");
    }

    //deletes selected artical in DB
    public function destroy(Artical $artical)
    {
        //check if selected artical is an artical the user has writen
        $this -> authorize("destroy", $artical);

        //via SQL
        Comment::where('artical_id', $artical -> id) -> delete(); 

        //remove junction entries
        $artical -> categories() -> sync([]);

        //remove artical
        $artical -> delete();

        //redirect to manage articals page
        return redirect("/profile/edit");
    }
}
