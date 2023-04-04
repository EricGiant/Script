<?php
namespace App\Http\Controllers;

use App\Http\Requests\storeGroceryRequest;
use App\Models\Category;
use App\Models\Grocery;
use Dotenv\Validator;
use Illuminate\Http\Request;

class GroceriesController
{
    function index()
    {
        //get all DB entries
        $groceries = Grocery::all();

        //calculate total price && add zeros if need to price
        $totalPrice = 0;

        $totalPrice = $groceries -> map(function($item)
        {
            //add zeros if needed
            $item["price"] = number_format($item["price"], 2, ".", "");

            //calculate total price of item
            return $item["amount"] * $item["price"];
        }) -> sum();

        //add zeroes to total price if needed
        $totalPrice = number_format($totalPrice, 2, ".", "");

        //show page
        return view("index", ["groceries" => $groceries, "totalPrice" => $totalPrice]);
    }

    function create()
    {
        //get categories
        $categories = Category::all();

        //load page
        return view("create", ["categories" => $categories]);
    }

    function store(storeGroceryRequest $request)
    {
        //make DB entry
        $grocery = new Grocery(
            [
                "name" => $request -> get("name"),
                "price" => $request -> get("price"),
                "amount" => $request -> get("amount"),
                "category_id" => $request -> get("category")
            ]
        );
        
        //save to DB
        $grocery -> save();

        //redirect to index
        return redirect("/index");
    }

    function edit($id)
    {
        //get categories
        $categories = Category::all();

        //get grocery
        $grocery = Grocery::find($id);

        //load page
        return view("edit", ["categories" => $categories, "grocery" => $grocery]);
    }

    function update(storeGroceryRequest $request, $id)
    {
        //find entry
        $entry = Grocery::find($id);

        //update entry
        $entry -> name = $request -> get("name");
        $entry -> price = $request -> get("price");
        $entry -> amount = $request -> get("amount");
        $entry -> category_ID = $request -> get("category");
        $entry -> save();

        //redirect to index
        return redirect("/index");
    }

    function destroy()
    {
        //get entry ID
        $ID = $_GET["id"];

        //find entry
        $entry = Grocery::find($ID);

        //remove entry
        $entry -> delete();

        //redirect to index
        return redirect("/index");
    }
}
?>