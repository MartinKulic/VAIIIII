<?php

namespace Database\Seeders;

use App\Models\Fav;
use App\Models\Image;
use App\Models\Rating;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'a',
        ]);

        DB::table('images')->insert([
            'path' => 'uploads/example/Xenh4ksZNU2utwaQkfemBc0QqNZVdD6mDYlq9XoR.jpg',
            'name' => 'Pohlad z internatu',
            'desc' => 'Pohlad z okne internatu (uz neviem ktoreho)',
            'autor_id' => 1,
        ]);

        DB::table('images')->insert([
            'path' => '	uploads/example/cHMX2lPDBAwqV8ckjLeptMPYAc8PStjrt9IMghVG.jpg',
            'name' => 'Pohlad z internatu',
            'desc' => 'Pohlad z okne internatu (uz neviem ktoreho)',
            'autor_id' => 1,
        ]);

        DB::table('favs')->insert([
            'user_id' => 1,
            'image_id' => 1
        ]);

        DB::table('ratings')->insert([
            'user_id' => 1,
            'image_id' => 1,
            'value' => 2,
        ]);
    }
}
