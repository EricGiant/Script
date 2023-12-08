<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserIngredientsRequest;
use App\Http\Requests\DeleteUserIngredientRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserIngredientRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UserMadeRecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make(($validated['password']));
        User::create($validated);
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

        auth()->user()->ingredients()->updateExistingPivot($validated['ingredientId'], ['amount' => $validated['amount']]);
    }

    public function deleteIngredient(DeleteUserIngredientRequest $request)
    {
        $this->authorize('deleteIngredient', User::class);

        $validated = $request->validated();

        auth()->user()->ingredients()->detach($validated['id']);
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $validated = $request->validated();

        User::where('email', DB::table('password_resets')->where('token', $validated['token'])->pluck('email'))->update(['password' => Hash::make($validated['password'])]);

        DB::table('password_resets')->where('token', $validated['token'])->delete();
    }

    public function madeRecipe(UserMadeRecipeRequest $request)
    {
        $this->authorize('madeRecipe', User::class);

        $validated = $request->validated();

        $userIngredients = auth()->user()->ingredients->toArray();
        $currentRecipe = Recipe::find($validated['recipeId']);
        foreach($currentRecipe->ingredients as $recipeIngredient)
        {
            foreach($userIngredients as $userIngredient)
            {
                if($userIngredient['id'] === $recipeIngredient['id'])
                {
                    $amount = $userIngredient['pivot']['amount'] - $recipeIngredient['pivot']['amount'];
                    if($amount <= 0)
                    {
                        auth()->user()->ingredients()->detach($userIngredient['id']);
                    }
                    else
                    {
                        auth()->user()->ingredients()->updateExistingPivot($userIngredient['id'], ['amount' => $amount]);
                    }
                    break;
                }
            }
        }


        $userRecipes = auth()->user()->recipes->toArray();
        foreach($userRecipes as $recipe)
        {
            if($recipe['id'] === $validated['recipeId'])
            {
                $amount = $recipe['pivot']['amount'] + 1;
                auth()->user()->recipes()->updateExistingPivot($validated['recipeId'], ['amount' => $amount]);
                return;
            }
        }

        auth()->user()->recipes()->attach($validated['recipeId'], ['amount' => 1, 'user_id' => auth()->user()->id]);
    }
}
