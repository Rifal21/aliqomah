<?php

namespace Database\Seeders;

use App\Models\Page;
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

        Page::create([
            'name' => 'home',
            'section' => 'jumbotron',
            'slug' => 'home-jumbotron',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'home',
            'section' => 'program',
            'slug' => 'home-program',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'home',
            'section' => 'testimoni',
            'slug' => 'home-testimoni',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'home',
            'section' => 'galeri',
            'slug' => 'home-galeri',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'about',
            'section' => 'about',
            'slug' => 'about',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'alumni',
            'section' => 'jumbotron',
            'slug' => 'alumni-jumbotron',
            'content' => null,
            'is_active' => true,
        ]);
        Page::create([
            'name' => 'alumni',
            'section' => 'sambutan',
            'slug' => 'alumni-sambutan',
            'content' => null,
            'is_active' => true,
        ]);
    }
}
