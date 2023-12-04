<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasFactory, HasPermissions;
    protected $guardName = 'api';
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
