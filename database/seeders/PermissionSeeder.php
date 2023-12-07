<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'book-list',
            'book-create',
            'book-edit',
            'book-deactivate',
            'book-list',
            'book-detail',
            'add-book-to-cart',
            'own-cart-view',
            'own-cart-update'
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
