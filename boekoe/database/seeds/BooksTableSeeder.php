<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->truncate();

        $faker = Factory::create();

        $books = [];


        for ($i = 1; $i <= 50; $i++)
        {
            $t = $faker->sentence(rand(2,4));
            $s = Str::slug($t);

            $books [] = [
                'title'         => $t,
                'slug'          => $s,
                'description'   => $faker->paragraphs(rand(8,12), true),
                'author_id'     => rand(1,8),
                'category_id'   => rand(1,6),
                'image_id'      => rand(1,30),
                'quantity'      => rand(10, 40),
                'price'         => rand(50, 300) * 1000,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')

            ];
        }

        DB::table('books')->insert($books);
    }
}
