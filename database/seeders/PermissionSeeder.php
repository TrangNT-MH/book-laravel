<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'name' => 'Nguyet Ha',
            'email' => 'nguyetha45@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => '',
        ]);
        $admin->assignRole('admin');

        $user = User::firstOrCreate([
            'name' => 'Trang Ha',
            'email' => 'trangha@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => '',
        ]);

        $user->assignRole('user');
        Permission::firstOrCreate([
            'name' => 'all',
            'description' => 'Have all permissions'
        ]);
        Permission::firstOrCreate([
            'name' => 'view-any-book',
            'description' => 'Can view the book list'
        ]);
        Permission::firstOrCreate([
            'name' => 'view-book',
            'description' => 'Can view details of a book']);

        Permission::firstOrCreate([
            'name' => 'update-book',
            'description' => 'Edit and update a book'
        ]);
        Permission::firstOrCreate([
            'name' => 'create-book',
            'description' => 'Create a new book'
        ]);
        Permission::firstOrCreate([
            'name' => 'chang-status-book',
            'description' => 'Create a new book'
        ]);

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo('all');

        $user = Role::where('name', 'user')->first();
        $user->givePermisisonTo([
            'view-any-book',
            'view-book',
        ]);
    }
}
