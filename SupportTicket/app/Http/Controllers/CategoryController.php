<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return(response(CategoryResource::collection(Category::all())));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request -> validated();

        $this -> authorize("create", Category::class);

        Category::create($validated);

        return($this -> index());
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request -> validated();

        $this -> authorize("update", Category::class);

        $category -> update($validated);
        
        return($this -> index());
    }

    public function delete(Category $category)
    {
        $this -> authorize("delete", Category::class);

        if(count($category -> tickets) > 0)
        {
            return response("ticketFound");
        }

        $category -> delete();

        return($this -> index());
    }
}
