<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Permission extends Model
{
    use HasFactory;
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
