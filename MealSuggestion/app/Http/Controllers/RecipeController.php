<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Recipe::class); //for some reason this is unauthrized

        return response(RecipeResource::collection(Recipe::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $this->authorize('create', Recipe::class);

        $validated = $request->validated();

        $recipe = Recipe::create($validated);

        $ingredientIds = [];
        foreach($validated['ingredients'] as $ingredient)
        {
            array_push($ingredientIds, $ingredient['ingredientId']);
        }

        $amountValues = [];
        foreach($validated['ingredients'] as $ingredient)
        {
            array_push($amountValues, ['amount' => $ingredient['amount']]);
        }

        $syncData = array_combine($ingredientIds, $amountValues);

        $recipe->ingredients()->sync($syncData);

        return response(new RecipeResource($recipe));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
