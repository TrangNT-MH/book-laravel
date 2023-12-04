<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
//use Tymon\JWTAuth\Contracts\JWTSubject;

//class User extends Authenticatable implements JWTSubject
class User extends Authenticatable
{
    protected $guardName = 'api';

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function detail($id)
    {
        return DB::table('users')
            ->where('id', $id)
            ->get();
    }

    /**
     * @param $key
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function find($key)
    {
        return DB::table('users')
            ->find($key);
    }

//    public function getJWTIdentifier()
//    {
//        return $this->getKey();
//    }
//
//    public function getJWTCustomClaims()
//    {
//            return [];
//    }
}

