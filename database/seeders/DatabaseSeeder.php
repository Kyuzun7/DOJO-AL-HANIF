<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin Hanif',
            'username' => 'superhanif',
            'role' => 'tier_1',
            'password' => bcrypt('rahasia123'), // Password kamu
        ]);
    }
}
