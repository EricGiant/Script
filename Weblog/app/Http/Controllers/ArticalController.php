<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use App\Models\artical_category_junction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
    //show index page
    public function index()
    {
        //get articals
        $articals = Artical::all();

        //sort on upload date aka inverse collection since most recent ID is the most recent post
        $articals = $articals -> reverse();

        //load page
        return view("artical/index", ["articals" => $articals]);
    }

    //show writing page
    public function create()
    {
        //writing page is currently broken so this code is all to be reworked

        //get categories
        $categories = Category::all();

        //load page
        return view("artical/create", ["categories" => $categories, "action" => "/articalStore"]);
    }

    //store new artical in DB
    public function store(Request $request)
    {
        //validate entry
        $attributes = $request -> validate([
            "title" => "required|max:255",
            "content" => "required",
            "categories" => "required|min:1"
        ]);

        //make artical DB entry
        $artical = new Artical([
            "author_id" => auth() -> user() -> id,
            "title" => $request -> get("title"),
            "content" => $request -> get("content")
        ]);

        //save artical DB entry
        $artical -> save();

        //make artical_category_junction DB entries and save it
        foreach($request -> get("categories") as $category)
        {
            $junction = new artical_category_junction([
                "category_id" => $category,
                "artical_id" => $artical -> id
            ]);
            $junction -> save();
        }

        //redirect to manage articals page
        return redirect("/profileEdit");
    }

    //show selected artical
    public function show($id)
    {
        //get artical
        $artical = Artical::find($id);

        //check if artical has been found
        if($artical == null)
        {
            return redirect("/");
        }

        //load page
        return view("artical/show", ["artical" => $artical]);
    }

    //show edit page for selected artical
    public function edit($id)
    {
        //this uses the same page as the create page this will most likely be made into a new page instead 
        //so all this code is to be changed

        //get artical
        $artical = Artical::find($id);
        
        //check if artical has been found
        if($artical == null)
        {
            return redirect("/profileEdit");
        }

        //check if selected artical is an artical the user has writen
        if($artical -> author_id != auth() -> user() -> id)
        {
            return redirect("/profileEdit");
        }

        //change categories into array so code can be reused on create page so a new page isn't needed to be made
        $selectedCategories = [];
        for($i = 0; $i < sizeOf($artical -> categories); $i++)
        {
            array_push($selectedCategories, $artical -> categories[$i] -> id);
        }

        //get all categories
        $categories = Category::all();

        dd(session());

        //load page
        return view("artical/create") -> with("title", $artical -> title) -> with("content", $artical -> content) -> with("category", $selectedCategories) -> with("action", "/articalUpdate") -> with("categories", $categories);
    }

    //update selected artical in DB
    public function update(Request $request)
    {
        //
    }

    //deletes selected artical in DB
    public function destroy()
    {
        //
    }

    //store new category to DB
    public function storeCategory(Request $request)
    {
        //code itself is fine but the pages this function is attachted to are to be changed
        //this should also properly be in it's own controller

        //validate entry
        $attributes = $request -> validate([
            "name" => "required|max:255"
        ]);

        //make DB entry
        $category = new Category([
            "name" => $request -> name
        ]);

        //save DB entry
        $category -> save();

        //redirect to writing page and load in all old data
        return back() -> with("title", $request -> data_title) -> with("content", $request -> data_content) -> with("category", $request -> data_category);
    }
}
