<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $postTitle = fake()->unique()->words(rand(2, 5), true);

            DB::table('posts')->insert([
                'title' => ucfirst($postTitle),
                'slug' => Str::slug($postTitle) . '-' . $i,
                'content' => fake()->paragraphs(3, true),
                'image' => 'post-' . rand(1, 10) . '.jpg',
                'status' => rand(0, 1),
                'user_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
