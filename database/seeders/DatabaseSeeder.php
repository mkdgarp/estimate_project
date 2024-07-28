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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'rank' => '0', //Admin bypass rank checked
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'rank' => '1', //Admin bypass rank checked
        ]);

        User::factory()->create([
            'name' => 'Professor',
            'email' => 'professor@mail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'rank' => '2', //Admin bypass rank checked
        ]);
    }
}
