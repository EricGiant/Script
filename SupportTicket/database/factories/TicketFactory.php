<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake() -> jobTitle(),
            "content" => fake() -> text(),
            "appointed_to_id" => rand(2, 6),
            "status_id" => rand(1 ,3),
        ];
    }
}
