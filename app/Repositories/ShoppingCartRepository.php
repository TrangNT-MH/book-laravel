<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use App\Repositories\EloquentRepository;

class ShoppingCartRepository extends EloquentRepository
{

    function getModel()
    {
        return ShoppingCart::class;
    }

    function content($identifier)
    {
        $this->model->where([
            'identifier' => $identifier,
            'instance' => 'cart'
        ])->value('content');
    }
}
