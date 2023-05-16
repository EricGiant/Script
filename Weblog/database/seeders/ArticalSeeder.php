<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("articals") -> insert([
            [
                "author_id" => 1,
                "title" => "The Importance of Mindfulness in Today's World",
                "content" => "In today's fast-paced world, it's easy to get caught up in the chaos and lose sight of what truly matters. We're constantly bombarded with information, distractions, and stressors that can leave us feeling overwhelmed and disconnected. That's why mindfulness is becoming increasingly important.
                Mindfulness is the practice of being present and aware in the moment, without judgment. It's about paying attention to our thoughts, feelings, and surroundings, and accepting them for what they are. This simple practice can have profound effects on our mental and physical health.
                Research has shown that mindfulness can reduce stress, anxiety, and depression, as well as improve sleep quality and cognitive function. It can also increase empathy, compassion, and overall well-being. By taking the time to be mindful, we can learn to be more focused, resilient, and present in our daily lives.
                So how can we cultivate mindfulness in our busy lives? There are many ways, including meditation, deep breathing exercises, and simply taking a few moments each day to check in with ourselves. It's important to find what works for you and make it a regular practice.
                In a world where we're constantly on the go, mindfulness can help us slow down and appreciate the present moment. It's a powerful tool for cultivating happiness, reducing stress, and improving our overall quality of life. So why not give it a try?",
                "isPremium" => 0
            ],
            [
                "author_id" => 1,
                "title" => "The Significance of Food: Nourishment, Culture, and Connection",
                "content" => "Food is an essential aspect of our lives. It fuels us, nourishes us, and brings us together. Whether it's a simple home-cooked meal or an elaborate feast, food has the power to evoke emotions and create memories.
                Eating a well-balanced diet is crucial for maintaining good health. Our bodies require a variety of nutrients to function properly, and a balanced diet ensures that we get them all. A diet that is high in fruits, vegetables, whole grains, and lean proteins can help reduce the risk of chronic diseases such as heart disease, diabetes, and cancer.
                Food is also an important part of our culture and heritage. Traditional dishes are often passed down from generation to generation, and they can tell a story about our ancestors and their way of life. Exploring different cuisines can also broaden our horizons and introduce us to new flavors and cooking techniques.
                In addition to its nutritional and cultural significance, food also has a social aspect. Sharing a meal with family and friends can bring people closer together and create a sense of community. From potlucks to dinner parties, food is often at the center of social gatherings.
                Overall, food is much more than just sustenance. It is a source of nourishment, culture, and connection. So whether you're cooking a meal for yourself or sharing a feast with loved ones, take the time to appreciate the importance of food in your life.",
                "isPremium" => 1
            ]
        ]);
    }
}
