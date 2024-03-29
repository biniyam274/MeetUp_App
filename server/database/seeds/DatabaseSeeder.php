<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
       for ($i=0; $i < 10; $i++) { 
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('meetups')->insert([
            'title' => Str::random(10),
            'location' => Str::random(10).' ,USA',
            'description' => Str::random(30),
            'imageUrl' => Str::random(6).'.jpg',
            'userId' => 1
        ]);
       }
    }
}
