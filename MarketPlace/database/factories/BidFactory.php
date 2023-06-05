<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Stmt\Global_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
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
            "user_id" => 1,
            "post_id" => 1,
            "amount" => fake() -> numberBetween(1, 200)
        ];

        //check if data exists already
        while(BidFactory::$allData -> contains("user_id", $data["user_id"]) && BidFactory::$allData -> contains("post_id", $data["post_id"]))
        {
            $data = [
                "user_id" => rand(1, User::count()),
                "post_id" => rand(1, Post::count()),
                "amount" => fake() -> numberBetween(1, 200)
            ];
        }

        //add to static so it can be used for checking
        BidFactory::$allData -> put("data" . BidFactory::$allData -> count(), $data);

        return $data;
    }
}
