<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Database\Factories\MessageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this uses statics to pass values needed for messagees
        //factory/seeding is something I very much do not like how it works in laravel so I just make it work
        //I do not care how bad this code is, it just has to work.

        $chats = Chat::factory(5) -> create();
        for($i = 0; $i < count($chats); $i++)
        {
            //get chat ID for message
            MessageFactory::$chat_id = $chats[$i]["id"];

            //get sender for first message
            MessageFactory::$sender_id = $chats[$i]["user1_id"];
            Message::factory(1) -> create();

            //get sender for second message
            MessageFactory::$sender_id = $chats[$i]["user2_id"];
            Message::factory(1) -> create();
        }
    }
}
