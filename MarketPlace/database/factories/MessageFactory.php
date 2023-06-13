<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //used to get ids for entry
    static $chat_id, $sender_id;

    public function definition()
    {
        return [
            "chat_id" => MessageFactory::$chat_id,
            "sender_id" => MessageFactory::$sender_id,
            "content" => fake() -> text()
        ];
    }
}
