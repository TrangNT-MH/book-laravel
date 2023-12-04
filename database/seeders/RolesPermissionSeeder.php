<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolesPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsByRole = [
            'admin' => [
                'all' => 'Have all permissions'
            ],
            'user' => [
                'add_book' => 'Can add a book to cart',
                'view_own_cart' => 'Can view your own cart',
                'delete_own_cart' => 'Delete your own cart'
            ]
        ];

        $insertPermissions = fn($role) => collect($permissionsByRole[$role])
            ->map(fn($description, $name) => Permission::create(['name' => $name, 'description' => $description])->id)
            ->toArray();

        $permissionIdsByRole = [
            'admin' => $insertPermissions('admin'),
            'user' => $insertPermissions('user')
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            collect($permissionIds)->map(function ($id) use ($role) {
                RolesPermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $id
                ]);
            });

        }
    }
}
