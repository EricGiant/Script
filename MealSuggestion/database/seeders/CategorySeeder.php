<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        define('CATEGORIES', ['Grains', 'Milk Products', 'Fruit Products', 'Eggs', 'Meats', 'Fishes', 'Vegtables', 'Fats', 'Nuts/Seeds', 'Suger Products', "Non-alcoholic Beverages", "Alcoholic Beverages"]);
        for($i = 0; $i < count(CATEGORIES); $i++)
        {
            Category::create(['name' => CATEGORIES[$i]]);
        }
    }
}
