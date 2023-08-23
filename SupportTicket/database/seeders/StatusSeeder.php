<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            "title" => "In afwatching",
        ]);
        Status::create([
            "title" => "In behandeling",
        ]);
        Status::create([
            "title" => "Afgehandeld"
        ]);
    }
}
