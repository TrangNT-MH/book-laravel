<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::all()->pluck('id')->toArray();
        $gender = fake()->randomElement(['male', 'female']);
        return [
            'user_id' => fake()->unique()->randomElement($user_id),
            'avatar' => fake()->image('public/images/faces'),
            'phoneNumber' => fake()->phoneNumber(),
            'gender' => $gender,
            'dob' => fake()->date($max = '2010-12-30')
        ];
    }
}
