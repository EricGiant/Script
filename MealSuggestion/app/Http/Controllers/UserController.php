<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddIngredientsRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function addIngredients(AddIngredientsRequest $request)
    {
        // $this->authorize('addIngredients', User::class);

        $validated = $request->validated();

        $ingredients = user::find(1)->ingredients;
        // $ingredients = auth()->user()->ingredients;

        //check for duplicate entries and if found remove it and add the amount to the validated so a new entry can be made
        foreach($ingredients as $ingredient)
        {
            for($i = 0; $i < count($validated); $i++)
            {
                if($validated[$i]['ingredient_id'] == $ingredient->id)
                {
                    $validated[$i]['amount'] += $ingredient->pivot->amount;
                    // auth() -> user() -> ingredients() ->detach($ingredient);
                    user::find(1) -> ingredients() -> detach($ingredient);
                    continue;
                }
            }
        }
        user::find(1)->ingredients()->attach($validated);
    }
}
