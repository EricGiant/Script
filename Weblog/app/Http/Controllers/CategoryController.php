<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //save new category to DB
    public function store(Request $request)
    {
        // TODO: validation in aparte Form Validator class zetten
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

        //get categories
        $categories = Category::all();

        //redirect to writing page or update page
        // TODO: waarom 2 routes?
        if(isset($request -> id))
        {
            return view("artical/edit", ["title" => $request -> data_title, "content" => $request -> data_content, "selectedCategories" => $request -> data_category, "id" => $request -> id, "categories" => $categories, "isPremium" => $request -> data_premium]);
        }
        else
        {
            return view("artical/create", ["title" => $request -> data_title, "content" => $request -> data_content, "selectedCategories" => $request -> data_category, "categories" => $categories]);

        }
    }
}
