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

        User::create([
            'name' => 'Rifal Kurniawan',
            'email' => 'rifal@gmail.com',
            'password' => bcrypt('123123123'),
            'is_admin' => true,
        ]);
    }
}
