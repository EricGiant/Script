<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    //store new category
    public function store(StoreCategoryRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //make new entry
        $category = Category::create($validated);

        //return back to page
        return back();
    }
}
