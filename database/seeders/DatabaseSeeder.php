<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use App\Models\User;
use App\Models\UsersRole;
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
//            UserSeeder::class,
//            PermissionSeeder::class,
//            RoleSeeder::class
//            CategorySeeder::class,
            GenreSeeder::class
        ]);
    }
}
