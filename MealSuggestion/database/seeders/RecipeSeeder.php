<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

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
            $ingredients = [];
            for($i = 0; $i < rand(2, 4); $i++)
            {
                array_push($ingredients, rand(1, Count(Ingredient::all())));
            }

            $syncData = array_fill_keys($ingredients, ["amount" => rand(1, 4)]);

            $recipe -> ingredients() -> sync($syncData);
        });
    }
}
