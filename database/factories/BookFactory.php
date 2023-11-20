<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $path = public_path('storage/images/books');
//        if (!file_exists($path)) {
//            File::makeDirectory($path, '777', true);
//        }
//
//        $imagePath = fake()->image('public/storage/images/books');
//        $image = str_replace('public/storage/', '', $imagePath);

        $image = 'https://picsum.photos/'. rand(2,200);
        $title = $this->faker->sentence(3, true);

        return [
            'title' => $title,
            'isbn10' => fake()->unique()->isbn10(),
            'author' => fake()->name(),
            'price' => fake()->randomFloat(2,0, 99999),
            'publication_date' => fake()->date(),
            'image' => $image
        ];
    }
}
