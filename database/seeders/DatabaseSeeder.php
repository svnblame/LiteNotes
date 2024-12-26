<?php

namespace Database\Seeders;

use App\Models\Note;
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

        $user = User::factory()
            ->has(
                factory: Note::factory()->count(3))
            ->create([
            'name' => 'Gene',
            'email' => 'gene@litenotes.com',
            'password' => bcrypt('password'),
        ]);

        Note::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Note',
            'text' => 'This is my first note',
        ]);
    }
}
