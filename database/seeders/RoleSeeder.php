<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $userPermissions = [
            'book-list',
            'book-detail',
            'add-book-to-cart',
            'own-cart-view',
            'own-cart-update'
        ];

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo($userPermissions);
    }
}
