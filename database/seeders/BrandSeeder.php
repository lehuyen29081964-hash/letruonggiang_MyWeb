<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $brandName = fake()->unique()->words(2, true);

            DB::table('brands')->insert([
                'brandname' => ucfirst($brandName),
                'slug' => Str::slug($brandName),
                'image' => 'brand-' . $i . '.jpg',
                'status' => 1,
                'sort_order' => $i,
                'description' => fake()->sentence(20),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
