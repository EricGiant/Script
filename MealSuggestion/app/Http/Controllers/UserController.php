<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserIngredientsRequest;
use App\Http\Requests\UpdateUserIngredientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

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

    public function addIngredients(AddUserIngredientsRequest $request)
    {
        $this->authorize('addIngredients', User::class);

        $validated = $request->validated();

        $userIngredients = auth()->user()->ingredients->toArray();
        foreach($validated as $entry)
        {
            for($i = 0; $i < count($userIngredients); $i++)
            {
                if($userIngredients[$i]['id'] === $entry['ingredientId'])
                {
                    $entry['amount'] += $userIngredients[$i]['pivot']['amount'];
                    auth()->user()->ingredients()->updateExistingPivot($entry['ingredientId'], ['amount' => $entry['amount']]);
                    continue 2;
                }
            }
            auth()->user()->ingredients()->attach($entry['ingredientId'], ['amount' => $entry['amount'], 'user_id' => auth()->user()->id]);
        }
    }

    public function updateIngredient(UpdateUserIngredientRequest $request)
    {
        $this->authorize('updateIngredient', User::class);

        $validated = $request->validated();

        //check if the user has this ingredient in there list, if this is not done it could try to update a value that doesn't exist
        //this doesn't seem to cause an error but I think something fishy could happen anyway so run the check here,
        //later do this check in the request but me and jeroen couldn't figure that out

        $foundIngredient = false;
        foreach(auth()->user()->ingredients as $ingredient)
        {
            if($ingredient['id'] === $validated['ingredientId'])
            {
                $foundIngredient = true;
                break;
            }
        }

        if(!$foundIngredient)
        {
            return response("NOT IN YOUR LIST", 404);
        }

        auth()->user()->ingredients()->updateExistingPivot($validated['ingredientId'], ['amount' => $validated['amount']]);
    }
}
