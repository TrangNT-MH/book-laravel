<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use HasFactory;
    const __TABLE = 'shoppingcart';

    public function content($identifier)
    {
        return DB::table(self::__TABLE)->where([
            'identifier' => $identifier,
            'instance' => 'cart'
        ])->value('content');
    }
}
