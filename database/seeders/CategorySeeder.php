<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['category' => 'Comics & Graphic Novels']);
        Category::create(['category' => 'Games & Activities']);
        Category::create(['category' => 'Fantasy']);
        Category::create(['category' => 'Fiction']);
        Category::create(['category' => 'Humorous']);
        Category::create(['category' => 'Classics']);
        Category::create(['category' => 'Business & Economics']);
        Category::create(['category' => 'Self-Help']);
        Category::create(['category' => 'Social']);
        Category::create(['category' => 'History']);
        Category::create(['category' => 'Culture']);
        Category::create(['category' => 'LGBT']);
        Category::create(['category' => 'Mystery & Detective']);
    }
}
