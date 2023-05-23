<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //this can keep page data when the values are given via request when following the naming scheme: data_[name of the key]
    //save new category to DB
    public function store(Request $request)
    {
        // TOOD: stop onderstaande validatie rules in aparte form validation class en noem "attributes" "validated" (is duidelijkere naamgeving)
        //validate entry
        $attributes = $request -> validate([
            "name" => "required|max:255|unique:categories,name"
        ]);

        //make DB entry
        $category = new Category($attributes);

        //save DB entry
        $category -> save();
        
        //get back location route name
        // TODO: dit moet op een makkelijkere manier kunnen, Laravel heeft hier vast iets voor, uitzoeken (localhost is statisch gecode en kan daarom mis
        // gaan als je op ander domein draait)
        $cameFrom = str_replace("http://localhost:8000", "", back() -> getTargetUrl());

        //get data
        $requestData = $request -> toArray();
        $keyWords = array_keys($requestData);
        $data = [];
        // TODO: onderstaande code is te ingewikkeld, herschrijven met duidelijkere code
        for($i = 0; $i < count($requestData); $i++)
        {
            if(str_contains($keyWords[$i], "data_"))
            {
                //get the key value for the array
                $key = str_replace("data_" , "",  $keyWords[$i]);

                //get the data for the key
                $keyData = $requestData[$keyWords[$i]];

                //load it into array
                $data[$key] = $keyData;
            }
        }

        //load in page
        return redirect($cameFrom) -> with(["data" => $data]);
    }
}
