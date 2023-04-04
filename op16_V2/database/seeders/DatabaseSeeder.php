<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        //categories data
        DB::table("categories")->insert([
            [
                "name" => "Beverages"
            ],
            [
                "name" => "Bread/Bakery"
            ],
            [
                "name" => "Canned/Jarred Goods"
            ],
            [
                "name" => "Dairy"
            ],
            [
                "name" => "Dry/Baking Goods"
            ],
            [
                "name" => "Frozen Foods"
            ],
            [
                "name" => "Meat"
            ],
            [
                "name" => "Produce"
            ],
            [
                "name" => "Other"
            ]
        ]);

        //test groceries
        DB::table("groceries")->insert([
            [
                "name" => "potatoe",
                "price" => 2.00,
                "amount" => 2,
                "category_id" => 8
            ],
            [
                "name" => "steak",
                "price" => 10.99,
                "amount" => 1,
                "category_id" => 7
            ]
        ]);
    }
}
