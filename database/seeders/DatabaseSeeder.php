<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'abdallah97sasa@gmail.com',
            'password' => 'abdallah97sasa@gmail.com',
            'email_verified_at' => now(),
        ]);

        $this->call([
            CaesarProductsSeeder::class,
        ]);

    }
}
