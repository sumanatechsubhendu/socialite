<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // Use the factory to create 10 fake posts
        Post::factory()->count(10)->create();
    }
}
