<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_detail',
        'ward',
        'district',
        'province',
        'is_default'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function updateDefault($id)
    {
            $address = Address::where('user_id', $id)->where('is_default', 1);
            $address->update(['is_default' => 0]);
    }
}
