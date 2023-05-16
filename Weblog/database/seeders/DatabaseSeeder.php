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
    public function run()
    {
        $this -> call([
            UserSeeder::class,
            ArticalSeeder::class,
            CategorySeeder::class,
            Artical_Category_JunctionSeeder::class
        ]);
    }
}
