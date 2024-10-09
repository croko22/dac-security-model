<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        User::factory(10)->create()->each(function ($user) {
            // For each user, create 5 notes
            Note::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });

        // Create a specific test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 10 notes for the test user
        Note::factory(10)->create([
            'user_id' => $testUser->id,
        ]);
    }
}
