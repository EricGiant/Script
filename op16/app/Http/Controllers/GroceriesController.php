<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Grocery;
use Illuminate\Http\Request;

class GroceriesController
{
    function index()
    {
        //get all DB entries
        $groceries = Grocery::all();

        //calculate total price && add zeros if need to price
        $totalPrice = 0;

        // TODO: bereken totaalprijs mbv array_reduce functie (zie php.net voor documentatie en voorbeelden)
        for($i = 0; $i < sizeof($groceries); $i++)
        {
            //add zeros
            $groceries[$i]["price"] = number_format($groceries[$i]["price"], 2, ".", "");

            //calculate total per item
            for($x = 0; $x < $groceries[$i]["amount"]; $x++)
            {
                $totalPrice += $groceries[$i]["price"];
            }
        }

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

    function store(Request $request)
    {
        // TODO: plaats validatie regels in Laravel form validation class (zie Laravel documentatie)
        //validate entry
        $request -> validate([
            "name" => "required|between:2,100",
            "price" => "required|numeric|between:0.01,9999.99",
            "amount" => "required|digits_between:1,100",
            "category" => "required|digits_between:1,9" //currently if u change the HTML via inspect it will make it so the cato if it hasn't been found will be equal to the number u fed it, I dont know if this is an issue
        ]);

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

    function edit()
    {
        //get categories
        $categories = Category::all();

        //load page
        return view("edit", ["categories" => $categories]);
    }

    function update(Request $request)
    {
        //validate entry
        $request -> validate([
            "name" => "required|between:2,100",
            "price" => "required|numeric|between:0.01,9999.99",
            "amount" => "required|digits_between:1,100",
            "category" => "required|digits_between:1,9"  //potentially add a check that checks if the category value is equal to an existing cato ID
        ]);

        // TODO: pas route-model binding toe zodat je een find query bespaart (zie Laravel documentatie)

        //get entry ID
        $ID = $_GET["id"];

        //find entry
        $entry = Grocery::find($ID);

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