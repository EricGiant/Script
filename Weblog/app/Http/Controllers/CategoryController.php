<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //this can keep page data when the values are given via request when following the naming scheme: data_[name of the key]
    //save new category to DB
    public function store(StoreCategoryRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //make DB entry
        $category = new Category($validated);

        //save DB entry
        $category -> save();
        
        //get back location route name
        $cameFrom = str_replace($request -> root(), "", back() -> getTargetUrl());

        //get data
        $requestData = $request -> toArray();
        $keyWords = array_keys($requestData);
        $data = [];
        // TODO: onderstaande code is te ingewikkeld, herschrijven met duidelijkere code:
        //wat is hier ingewikkeld aan? het enige wat het doet is het pakt data uit de request, haalt "data_" uit de key en plaats het in een nieuwe array
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
