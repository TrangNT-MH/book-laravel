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

    public function cart($identifier): void
    {
//        dd($identifier);
        $a = $this->model->where([
            'identifier' => $identifier,
            'instance' => 'cart'
        ])->get();
    }
}
