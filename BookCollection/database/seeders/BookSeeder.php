<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++)
        {
            // TODO: gebruik count method op de factory om 5 books te maken (dit
            // spaart je weer een for-loop uit). De naam iterator i kun je dan als
            // static counter property in de factory zetten en incrementen met
            // self::counter++
            Book::factory() -> create([
                "image_path" => "/storage/images/default" . $i + 1 . ".jpg"
            ]);
        }
    }
}
