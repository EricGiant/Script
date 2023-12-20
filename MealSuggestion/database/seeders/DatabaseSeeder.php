<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // TODO: onderstaande regel hoort in de CategorySeeder thuis
        define('CATEGORIES', ['Grains', 'Milk Products', 'Fruit Products', 'Eggs', 'Meats', 'Fishes', 'Vegtables', 'Fats', 'Nuts/Seeds', 'Suger Products', "Non-alcoholic Beverages", "Alcoholic Beverages"]);

        $this->call([
            CategorySeeder::class,
            IngredientSeeder::class,
            RecipeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
