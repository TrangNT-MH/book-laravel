<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PasswordResetToken extends Model
{
    use HasFactory;

    public static function insert($data)
    {
        DB::table('password_reset_tokens')->insert($data);
    }
}
