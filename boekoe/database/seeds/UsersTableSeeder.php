<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset users table
        DB::table('users')->truncate();

        // insert 3 users
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@boekoe.com',
                'password'=> bcrypt('secret'),
                'role_id'=> 1,
                'is_active'=> 1
            ],
            [
                'name'=> 'San',
                'email'=> 'san@gmail.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 2,
                'is_active'=> 1
            ],
            [
                'name'=> 'Sel',
                'email'=> 'sel@gmail.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 2,
                'is_active'=> 1
            ],
            [
                'name'=> 'Bil',
                'email'=> 'bil@gmail.com',
                'password'=> bcrypt('123456'),
                'role_id'=> 2,
                'is_active'=> 1
            ],
        ]);
    }
}
