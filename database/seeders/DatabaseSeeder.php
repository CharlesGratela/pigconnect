<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'farmer',
            'email_verified_at' => null, // Unverified email to test the fix
        ]);
        
        // Create a verified farmer user for comparison
        User::factory()->create([
            'name' => 'Verified Farmer',
            'email' => 'farmer@example.com',
            'role' => 'farmer',
            'email_verified_at' => now(), // Verified email
        ]);
        
        // Create a verified buyer user
        User::factory()->create([
            'name' => 'Test Buyer',
            'email' => 'buyer@example.com',
            'role' => 'buyer', 
            'email_verified_at' => now(), // Verified email
        ]);
    }
}
