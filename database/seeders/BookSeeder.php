<?php

namespace Database\Seeders;

use App\Models\Book;
use Database\Factories\BookFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        factory('Book', 10)->create();
        Book::factory(10)->create();
    }
}
