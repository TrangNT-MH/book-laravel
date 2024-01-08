<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Database\Factories\UserInfoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = count(User::all());
        UserInfo::factory()->count($user)->create();
    }
}
