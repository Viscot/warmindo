<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'name' => 'admin warungkuy',
            'password' => bcrypt('rahasia')

        ]);
        $this->call([CategorySeeder::class, MenuSeeder::class]);
    }
}
