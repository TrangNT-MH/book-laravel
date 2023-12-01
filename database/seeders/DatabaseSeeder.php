<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\admin::factory(10)->create();

        // \App\Models\admin::factory()->create([
        //     'name' => 'Test admin',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
//            UserSeeder::class,
//            BookSeeder::class,
//            RoleSeeder::class,
//            PermissionSeeder::class,
//            UsersRoleSeeder::class,
//            RolesPermissionSeeder::class
        ]);
    }
}
