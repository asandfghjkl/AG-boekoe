<?php

use Faker\Factory;
use App\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $authors = [];

        for($i = 1; $i <= 8; $i++)
        {
            $n = $faker->name;
            $s = Str::slug($n);

            $authors [] = [
                'name' => $n,
                'slug'=> $s,
                'bio' => $faker->paragraphs(rand(2,4), true)
            ];
        }

        Author::truncate();
        Author::insert($authors);
    }
}
