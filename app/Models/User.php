<?php

namespace App\Models;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
//use Tymon\JWTAuth\Contracts\JWTSubject;
//class User extends Authenticatable implements JWTSubject
class User extends Authenticatable implements MustVerifyEmail
{
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

    const __TABLE = 'users';

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function user_infos()
    {
        return $this->belongsTo(UserInfo::class);
    }
//    public function updatePassword($email, $password)
//    {
//        return DB::table(self::__TABLE)
//            ->where('email', $email)
//            ->update([
//                'password' => $password
//            ]);
//    }

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

