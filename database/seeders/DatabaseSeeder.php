<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
  

    public function run()
    {
        // \App\Models\User::factory(10)->create();

      
        $faker = \Faker\Factory::create();

        DB::table('posts')->insert([
            'title' => $faker->word,
            'post_text' => $faker->sentence,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
