<?php
namespace App\Traits;

use App\Models\Role;

trait HasPermission
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($roles)
    {
        return $this->roles()->contains('name', $roles);
    }

    public function hasPermission($permission)
    {

    }
}
