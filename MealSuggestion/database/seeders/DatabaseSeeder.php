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
        $this -> call([
            CategorySeeder::class,
            IngredientSeeder::class,
            IngredientStockListSeeder::class, //how this will work is a problem for future me, ask jasper for help on this
            RecipeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
