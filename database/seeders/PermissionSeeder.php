<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view_books', 'description' => 'Can view the book list']);
        Permission::create(['name' => 'view_book', 'description' => 'Can view details of a book']);
        Permission::create(['name' => 'update_book', 'description' => 'Edit and update a book']);
        Permission::create(['name' => 'create_book', 'description' => 'Create a new book']);
    }
}
