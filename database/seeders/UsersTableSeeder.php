<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()
            ->admin()
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => 'password', // Password will be hashed by the mutator
            ]);

        // Create regular users
        User::factory()
            ->count(10)
            ->create();
    }
}
