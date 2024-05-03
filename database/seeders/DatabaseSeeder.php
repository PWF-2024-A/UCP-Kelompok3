<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(

            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$0j6k/7vzq288I7bwSh8nduMx7wN1DRVn3kHRwHL75PnnG4Ih2yz9K',
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]
        );

        User::factory(100)->create();
        Todo::factory(500)->create();
        Category::factory(100)->create();
    }
}
