<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticalRequest;
use App\Models\Artical;
use App\Models\artical_category_junction;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

        //load page
        return view("artical/create", ["categories" => $categories]);
    }

    //stores new artical in DB
    public function store(ArticalRequest $request)
    {
        //make artical DB entry
        // TODO: plaats altijd de gevalideerde data uit ArticalRequest in de new functie, en niet de data via request->get, omdat
        // laatstgenoemde niet gevalideerd, en dus onveilig, is!
        $artical = new Artical([
            "author_id" => auth() -> user() -> id,
            "title" => $request -> get("title"),
            "content" => $request -> get("content"),
            "isPremium" => $request -> get("premium")
        ]);

        //wont work normally BECAUSE I CANT FIND THE FCKING FILE THAT INCREASED PACKET SIZE SO ONLY WORKS VIA SQL COMMANDS
        //SET GLOBAL max_allowed_packet=1073741824;
    
        //add image if needed
        if($request -> file("image"))
        {
            //check if file is actual image
            $extention = $request -> file("image") -> extension();
            // TODO: extension controleren via Laravel Form Validator class
            if($extention == "png" || $extention == "jpg")
            {
                //check if file is smaller than 16MB
                if($request -> file("image") -> getSize() / 1024 / 1024 < 16);
                {
                    //add image to DB entry
                    $artical -> image = $request -> file("image") -> get();
                }
            }
        }

        //save artical DB entry
        $artical -> save();

        //make artical_category_junction DB entries and save it
        // TODO: vervangen voor sync
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
        // TODO: route-model binding toepassen
        $artical = Artical::find($id);

        //check if artical has been found
        // TODO: controle kan er uit, of anders controleren op instanceof ipv null
        if($artical == null)
        {
            return redirect("/");
        }

        //check if artical is premium and if user is premium
        // TODO: schrijf eigen middleware om onderstaande controle uit te voeren zodat je show functie netter blijft (minder code bevat)
        if($artical -> isPremium)
        {
            //check if user is premium
            if(auth() -> user() == null || !auth() -> user() -> isPremium)
            {
                //return to index
                return redirect("/");
            }
        }

        //encode image to base64 so img can load it
        $artical -> image = base64_encode($artical -> image);

        //load page
        return view("artical/show", ["artical" => $artical]);
    }

    //show edit page for selected artical
    public function edit($id)
    {
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

        //get all categories
        $categories = Category::all();

        //load page
        return view("artical/edit", ["artical" => $artical, "categories" => $categories]);
    }

    //update selected artical in DB
    public function update(ArticalRequest $request, $id)
    {
        //find entry
        $artical = Artical::find($id);

        //check if artical has been found
        if($artical == null)
        {
            return redirect("/profileEdit");
        }
        
        //check if selected artical is an artical the user has writen
        // TODO: maak policy voor onderstaande controle, voor nettere, herbuikbare code
        if($artical -> author_id != auth() -> user() -> id)
        {
            return redirect("/profileEdit");
        }

        //update junction entries
        $artical -> categories() -> sync($request -> categories);

        //add image if needed
        if($request -> file("image"))
        {
            //check if file is actual image
            $extention = $request -> file("image") -> extension();
            if($extention == "png" || $extention == "jpg")
            {
                //check if file is smaller than 16KB
                if($request -> file("image") -> getSize() / 1024 / 1024 < 16);
                {
                    //add image to DB entry
                    $artical -> image = $request -> file("image") -> get();
                }
            }
        }

        //update artical entry
        $artical -> title = $request -> get("title");
        $artical -> content = $request -> get("content");
        $artical -> isPremium = $request -> get("premium");
        $artical -> save();


        //redirect to manage articals page
        return redirect("/profileEdit");
    }

    //deletes selected artical in DB
    public function destroy()
    {
        //
    }
}
