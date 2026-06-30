<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $fullName = fake()->name();
            $username = Str::slug($fullName, '_') . $i;
            DB::table('users')->insert([
                'fullname' => $fullName,
                'username' => $username,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
                'phone' => '09123456' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'address' => fake()->address(),
                'gender' => rand(0, 2),
                'birthday' => fake()->date('Y-m-d', '2003-12-31'),
                'role' => rand(1, 2),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
