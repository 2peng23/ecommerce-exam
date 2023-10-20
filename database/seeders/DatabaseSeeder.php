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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'usertype' => 1,
            'email' => 'admin@admin.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'User',
            'usertype' => 0,
            'email' => 'user@user.com',
        ]);
    }
}
