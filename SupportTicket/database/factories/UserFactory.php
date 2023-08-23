<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "first_name" => fake() -> firstName(),
            "last_name" => fake() -> lastName(),
            "email" => fake() -> unique() -> safeEmail(),
            "password" => Hash::make("password"),
            "is_admin" => rand(0,1),
            "telephone_number" => fake() -> phoneNumber()
        ];
    }
}
