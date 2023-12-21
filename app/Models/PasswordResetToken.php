<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PasswordResetToken extends Model
{
    use HasFactory;

    const __TABLE = 'password_reset_tokens';

    public static function insert($data)
    {
        DB::table(self::__TABLE)->insert($data);
    }

    public function find($token)
    {
        return DB::table(self::__TABLE)
            ->where('token', $token)
            ->first()?->email;
    }

    public function existToken($email)
    {
        return DB::table(self::__TABLE)
            ->where('email', $email)
            ->get();
    }

    public function deleteByToken($email, $token)
    {
        return DB::table(self::__TABLE)
            ->where([
                'email' => $email,
                'token' => $token])
            ->delete();
    }
}
