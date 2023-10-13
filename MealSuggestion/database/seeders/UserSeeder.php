<?php

namespace Database\Seeders;

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
        User::create(['name' => 'ellie', 'email' => 'ellie@mail.com', 'password' => Hash::make('test')]);
        User::factory(5)->create(); //also seed 3 recipes the user has made, same problem as the stock list so ask jasper
    }
}
