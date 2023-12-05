<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        // Use the factory to create 5 fake videos
        \App\Models\Video::factory(5)->create();
    }
}
