<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Response;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::where("id", "!=", "1") -> each(function($user)
        {
            $ticket = Ticket::factory() -> for($user) -> has(Category::factory()) -> create();
            Response::factory() -> create(["ticket_id" => $ticket["id"]]);
        });
    }
}
