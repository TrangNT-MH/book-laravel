<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use App\Repositories\EloquentRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

class ShoppingCartRepository extends EloquentRepository
{

    function getModel()
    {
        return ShoppingCart::class;
    }

    public function cart($identifier)
    {
        $stored = $this->model->where([
            'identifier' => $identifier,
            'instance' => 'cart'
        ])->first();
        if ($stored) {
            return unserialize($stored->content);
        } else {
            return null;
        }
    }
}
