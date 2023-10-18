<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::factory(10) -> create() -> each(function ($recipe)
        {
            $loopValue = rand(2, 4);
            $ingredientIds = [];
            for($i = 0; $i < $loopValue; $i++)
            {
                array_push($ingredientIds, rand(1, Count(Ingredient::all())));
            }

            $amountValues = [];
            for($i = 0; $i < $loopValue; $i++)
            {
                array_push($amountValues, ['amount' => rand(1, 4)]);
            }

            $syncData = array_combine($ingredientIds, $amountValues);

            $recipe -> ingredients() -> sync($syncData);
        });
    }
}
