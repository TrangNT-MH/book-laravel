<?php
namespace App\Traits;

use App\Models\Role;
use function PHPUnit\Framework\isEmpty;

trait HasPermission
{
    public function hasRole($roles)
    {
        return $this->roles->contains('name', $roles);
    }

    public function getPermissions()
    {
        $role = $this->roles->get();
        if (isEmpty($role)) {
            return collect();
        }

        $permissions = $role->flatMap(function ($role) {
            return $role->permissions;
        });

        return $permissions->unique('id');
    }
    public function hasPermission($permission)
    {
        return $this->getPermissions()->contains('name', $permission);
    }
}
