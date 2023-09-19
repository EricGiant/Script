<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "first_name" => "admin",
            "last_name" => "admin",
            "email" => "admin@mail.com",
            "password" => Hash::make("admin"),
            "is_admin" => true,
            "telephone_number" => "(999) 999-9999"
        ]);
        User::factory(5) -> create();
    }
}
