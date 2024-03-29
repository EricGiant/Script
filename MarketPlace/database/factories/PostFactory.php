<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => rand(1, User::count()),
            "name" => fake() -> sentence(),
            "content" => fake() -> text(),
            "image_path" => "storage/images/default.png",
            "advertised_at" => Carbon::now()
        ];
    }
}
