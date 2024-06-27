<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true
        ]);
        User::factory()->create([
            'name' => 'Jahid Hasan',
            'email' => 'jahid@example.com',
        ]);
        Listing::factory(10)->create([
            'user_id' => 1
        ]);
        Listing::factory(10)->create([
            'user_id' => 2
        ]);
    }
}
