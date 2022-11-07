<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Nithi' ,
            'email' => 'nithi@example.com'
        ]);
        User::factory()->create([
            'name' => 'Surya' ,
            'email' => 'surya@@example.com'
        ]);

        Post::factory(8)->create();
        Post::factory(10)->create([
            'user_id' => 1
        ]);
        Post::factory(10)->create([
            'user_id' => 2
        ]);

    }
}
