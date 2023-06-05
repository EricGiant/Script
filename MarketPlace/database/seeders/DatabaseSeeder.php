<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bid;
use App\Models\Category;
use Database\Factories\BidFactory;
use Database\Factories\CategoryFactory;
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
        //this static weird stuff is so I can generate unique data
        //the unique() wasn't working and in the post case I couldn't even use it so had to
        //make something custom. this works incredibly well although a bit messy

        //set collection for the statics
        BidFactory::$allData = Bid::all();
        CategoryFactory::$allData = Category::all();

        //run seeders
        $this -> call([
            UserSeeder::class,
            PostSeeder::class,
            BidSeeder::class,
            CategorySeeder::class,
            ChatSeeder::class
        ]);
    }
}
