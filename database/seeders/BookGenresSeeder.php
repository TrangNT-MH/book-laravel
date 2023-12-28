<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genre = Genre::all();
        Book::all()->each(function ($book) use ($genre) {
            $book->genre()->attach(
                $genre->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
