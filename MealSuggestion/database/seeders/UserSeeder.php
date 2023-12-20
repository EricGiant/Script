<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: onderstaande code is de cryptisch. Kan eenvoudiger.
        User::create(['name' => 'ellie', 'email' => 'ellie@mail.com', 'password' => Hash::make('test')])->each(function ($user)
        {
            $this->addUserInfo($user);
        });

        User::factory(5)->create()->each(function ($user)
        {
            $this->addUserInfo($user);
        });
    }

    function addUserInfo($user)
    {
        $loopValue = 3;
        $recipeIds = [];
        for($i = 0; $i < $loopValue; $i++)
        {
            $recipeId = rand(1, Count(Recipe::all()));
            while(in_array($recipeId, $recipeIds))
            {
                $recipeId = rand(1, Count(Recipe::all()));
            }
            array_push($recipeIds, $recipeId);
        }

        $recipeAmountValues = [];
        for($i = 0; $i < $loopValue; $i++)
        {
            array_push($recipeAmountValues, ['amount' => rand(1, 4)]);
        }

        $syncData = array_combine($recipeIds, $recipeAmountValues);

        $user->recipes()->sync($syncData);

        $ingredientIds = [];
        for($i = 0; $i < $loopValue; $i++)
        {
            $ingredientId = rand(1, Count(Ingredient::all()));
            while(in_array($ingredientId, $ingredientIds))
            {
                $ingredientId = rand(1, Count(Ingredient::all()));
            }
            array_push($ingredientIds, $ingredientId);
        }

        $ingredientAmountValues = [];
        for($i = 0; $i < $loopValue; $i++)
        {
            array_push($ingredientAmountValues, ['amount' => rand(1, 5)]);
        }

        $syncData = array_combine($ingredientIds, $ingredientAmountValues);

        $user->ingredients()->sync($syncData);
    }
}
