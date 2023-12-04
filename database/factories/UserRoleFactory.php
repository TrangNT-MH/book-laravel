<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $user = User::pluck('id')->toArray;
//        $role = Role::pluck('id')->toArray;
        return [
            'user_id' => User::factory(),
//            'role_id' =>fake()->randomElement($role)
        ];
    }
}
