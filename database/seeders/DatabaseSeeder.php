<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(5)->create();
         Author::factory(3)->create();
//         Book::factory()->create([
//             'title' => fake()->title(),
//             'description' => fake()->text(),
//             'number' => fake()->numberBetween(1,1000),
//         ]);

    }
}
