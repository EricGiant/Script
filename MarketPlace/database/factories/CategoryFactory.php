<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    //static of the generated data
    static $allData;

    public function definition()
    {
        //make data
        $data = [
            "name" => fake() -> colorName()
        ];

        //check if data exists already
        while(CategoryFactory::$allData -> contains("name", $data["name"]))
        {
            $data = [
                "name" => fake() -> colorName()
            ];
        }

        //add to static so it can be used for checking
        CategoryFactory::$allData -> put("data" . CategoryFactory::$allData -> count(), $data);
       
        return $data;
    }
}