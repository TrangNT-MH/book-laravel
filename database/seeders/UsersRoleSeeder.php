<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UsersRole;
use Database\Factories\UserRoleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all()->count();
        $role = Role::all()->count();

        $user_role = [];
        for($i = 1; $i <= $user; $i++) {
            for($j = 1; $j <= $role; $j++) {
                $user_role[] = $i . "-" . $j;
            }
        }

        while ($user > 0) {
            $user_and_role = fake()->unique()->randomElement($user_role);
            $user_and_role = explode('-', $user_and_role);
            UsersRole::create([
                'user_id' => $user_and_role[0],
                'role_id' => $user_and_role[1]
            ]);
            $user--;
        }
    }
}
