<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Artical_Category_JunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("artical_category_junctions") -> insert([
            [
                "category_id" => 1,
                "artical_id" => 1,
            ],
            [
                "category_id" => 2,
                "artical_id" => 1,
            ],
            [
                "category_id" => 3,
                "artical_id" => 1,
            ],
            [
                "category_id" => 4,
                "artical_id" => 1,
            ],
            [
                "category_id" => 5,
                "artical_id" => 2
            ],
            [
                "category_id" => 6,
                "artical_id" => 2
            ]
        ]);
    }
}
