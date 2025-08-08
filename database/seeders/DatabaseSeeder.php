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
    // DB::table('users')->truncate(); // 💥 CAUTION: This will delete all users

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);
         $this->call(LoanDetailsTableSeeder::class);
         $this->call(UserTableSeeder::class);

    }
}
