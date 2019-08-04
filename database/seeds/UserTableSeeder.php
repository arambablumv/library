<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        User::insert([
            [
                'name' => 'Violence',
                'email' => 'librarian@admin.com',
                'password' => bcrypt('123456'),
                'role' => 'librarian',
                "created_at" => $faker->dateTimeThisMonth(),
            ]
        ]);
    }
}
